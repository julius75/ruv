<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        try {
            $user = User::create($input);

            $user->assignRole('user');

            $user->phone_numbers()->create([
               'phone_number'=>$phone_number,
               'user_default'=>true,
               'created_at'=>Carbon::now(),
               'updated_at'=>Carbon::now(),
            ]);

        } catch (\Exception $exception) {
            return response()->json(['message' => $exception], Response::HTTP_BAD_REQUEST);
        }

        $token = $this->getPassportToken($request->email, $request->password);

        return response()->json(
            [
                'user_details' => $user,
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
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $token = $this->getPassportToken($request->get('email'), $request->get('password'));

            return response()->json(
                [
                    'user_details' => $user,
                    'token' => $token,
                ],
                Response::HTTP_OK
            );
        }else{
            return response()->json(['message' => 'Invalid Credentials'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
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
}
