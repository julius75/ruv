<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendSms;
use App\Mail\Passcode;
use App\Mail\Registered;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Login
 *
 * APIs for user authentication
 */
class AuthController extends Controller
{
    /**
     * Register User
     *
     * Registers user to the system.
     * A bearer token is provided after successful registration which you can store and use for authentication while
     * presenting the OTP Passcode in the next stage before user login.
     * @bodyParam first_name string required First Name.
     * @bodyParam last_name string required Last Name.
     * @bodyParam email string required Email Address.
     * @bodyParam phone string required Phone Number, prefixed.
     * @bodyParam provider_id string required Teleco Provider ID.
     * @bodyParam password string required Password min 8 characters.
     * @bodyParam password_confirm string required Password, must match password.
     */
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users',
                'phone_number' => 'required|unique:phone_numbers',
//                'provider_id' => 'required|exists:providers,id',
                'password' => 'required|min:8',
                'password_confirm' => 'required|same:password',
            ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $input = $request->only(
            'first_name', 'last_name', 'email', 'password'
        );

        $input['password'] = Hash::make($input['password']);
        // remove non digits including spaces, - and +
        $phone_number = preg_replace("/[^0-9]/", "", $request->get('phone_number'));
        $user = null;
        $user_details = [];
        try {
            $passcode = $this->passcode();
            $user = User::create([
                'first_name'=>$input['first_name'],
                'last_name'=>$input['last_name'],
                'email'=>$input['email'],
                'password'=>$input['password'],
                'is_active'=>true,
                'passcode'=>$passcode
            ]);

            $user->assignRole('user');

            $user->phone_numbers()->create([
               'provider_id'=>$request->provider_id ?? 1,
               'phone_number'=>$phone_number,
               'user_default'=>true,
               'is_active'=>false,
               'created_at'=>Carbon::now(),
               'updated_at'=>Carbon::now(),
            ]);

            $details = [
                'name' => $user->first_name.' '.$user->last_name,
                'passcode' => $passcode,
                'to' => $user->email,
            ];

            Mail::send(new Passcode($details));
            $smsData = ['to'=>$phone_number, 'message'=>'Your Phone Verification Code is '.$passcode];
            SendSms::dispatch($smsData);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception], Response::HTTP_BAD_REQUEST);
        }

        $token = $this->getPassportToken($request->email, $request->password);
        if ($user!=null){
            $phone_numbers =$user->phone_numbers()->select(['phone_number','is_active', 'user_default', 'provider_id'])->get();
            $phone_numbers->map(function ($phone_number){
                $phone_number->provider=Provider::find($phone_number->provider_id, ['id', 'name', 'logo']);
                unset($phone_number->provider_id);
            });
            $user_details = [
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'is_active'=>$user->is_active,
                'phone_numbers'=>$phone_numbers,
            ];
        }

        return response()->json(
            [
                'user_details' => $user_details,
                'token' => $token,
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Login
     *
     * Log a user into the system. After successful login, a bearer token is returned which you may store and use for
     * authentication for guarded routes. Note that this token has an expiry duration therefore you should implement
     * a mechanism to check whether the token has expired before requiring the user to login again.
     * @bodyParam email string required Email address.
     * @bodyParam password string required Password.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $check_if_active = User::where('email', '=', $request->get('email'))->first();
        if ($check_if_active){
            if ($check_if_active->is_active == false){
                return response()->json(['message' => 'User Account is Inactive, contact support@ruv.com for assistance'], Response::HTTP_BAD_REQUEST);
            }
        }

        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();

            if (env('APP_ENV') == 'production') {
                $token = $this->getPassportToken($request->get('email'), $request->get('password'));
            }
            else {
                //mimic production response
                $token = [
                    "token_type"=>"Bearer",
                    "expires_in"=>604800,
                    "access_token"=>$user->createToken('authToken')->accessToken
                ];
            }
            $phone_numbers =$user->phone_numbers()->select(['phone_number','is_active', 'user_default', 'provider_id'])->get();
            $phone_numbers->map(function ($phone_number){
                $phone_number->provider=Provider::find($phone_number->provider_id, ['id', 'name', 'logo']);
                unset($phone_number->provider_id);
            });

            $user_details = [
                'first_name'=>$user->first_name,
                'last_name'=>$user->last_name,
                'email'=>$user->email,
                'is_active'=>$user->is_active,
                'phone_numbers'=>$phone_numbers,
            ];

            return response()->json(
                [
                    'user_details' => $user_details,
                    'token' => $token,
                ],
                Response::HTTP_OK
            );

        }else{
            return response()->json(['message' => 'Invalid Credentials'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Get Laravel Passport Token
     * @param $username
     * @param $password
     * @return mixed
     */
    protected function getPassportToken($username, $password)
    {
        $http = new Client;
        $form_params = [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('app.passport_client_id'),
                'client_secret' => config('app.passport_client_secret'),
                'username' => $username,
                'password' => $password,
                'scope' => '*',
            ]
        ];
        $response = $http->post(
            config('app.token_url'),
            $form_params
        );
        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Email Unique Check
     *
     * Check whether the provided email in user registration form is unique.
     * @bodyParam email string required Email address.
     */
    public function emailUnique(Request $request)
    {
        $unique = !User::where('email', $request->email)->exists();

        return response()->json(['message' => $unique], Response::HTTP_OK);
    }

    /**
     * Phone Number Unique Check
     *
     * Check whether the provided phone number in user registration form is unique
     * @bodyParam phone_number string required Phone number.
     */
    public function phoneUnique(Request $request)
    {
        // remove non digits including spaces, - and +
        $phone = preg_replace("/[^0-9]/", "", $request->phone_number);
        $unique = !PhoneNumber::where('phone_number','=', $phone)->exists();

        return response()->json(['message' => $unique], Response::HTTP_OK);
    }

    /**
     * Verify Passcode (OTP)
     *
     * Verify passcode provided by the user for OTP.
     * @authenticated
     * @bodyParam passcode string required Passcode that was sent via Email.
     */
    public function verifyPasscode(Request $request)
    {
        if (Auth::user()->default_phone_number()->phone_verified_at != null) {
            return response()->json(['message' => 'Passcode already verified'], Response::HTTP_OK);
        }

        if ($request->passcode == Auth::user()->passcode) {
            Auth::user()->default_phone_number()->update(['phone_verified_at' => Carbon::now(), 'is_active'=>true]);
            $details = [
                'name' => Auth::user()->first_name. ' '.Auth::user()->last_name,
                'to' => Auth::user()->email,
            ];
            Mail::send(new Registered($details));

            return response()->json(['message' => 'Passcode verified. Please login'], Response::HTTP_OK);
        }
        else {
            return response()->json(['message' => 'Invalid passcode'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Logout
     *
     * Log a user out of the system.
     * @authenticated
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        if (Auth::check()){
            Auth::user()->tokens->each(function ($token, $key){
                $token->delete();
            });
            return response()->json(['message' => 'User Logged Out Successfully'], Response::HTTP_OK);
        }
        return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
    }

    protected function passcode($min = 1000, $max = 9999)
    {
        return mt_rand($min, $max);
    }
}
