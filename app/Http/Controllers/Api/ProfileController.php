<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendSms;
use App\Mail\Passcode;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\Transaction;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group User Profile Management
 *
 * APIs for managing user profile and phone numbers
 */
class ProfileController extends Controller
{

    /**
     * User's Profile
     *
     * Provides data for the profile page e.g. first_name, last_name, email and phone numbers
     * @authenticated
     */
    public function index(){
        $profile = Auth::user();
        if (!$profile){
            return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
        }
        $phone_numbers =$profile->phone_numbers()->select(['phone_number','is_active', 'user_default', 'provider_id'])->get();
        $phone_numbers->map(function ($phone_number){
            $phone_number->provider=Provider::find($phone_number->provider_id, ['id', 'name', 'logo']);
            unset($phone_number->provider_id);
        });
        $data['first_name']=$profile->first_name;
        $data['last_name']=$profile->last_name;
        $data['email']=$profile->email;
        $data['is_active']=$profile->is_active;
        $data['phone_numbers']=$phone_numbers;
        return response()->json(['message' => compact('data')], Response::HTTP_OK);
    }

    /**
     * Edit User's Profile
     *
     * Change User Profile details
     * @bodyParam first_name string required Last Name.
     * @bodyParam last_name string required First Name.
     * @bodyParam email string required Email Address.
     * @authenticated
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editProfile(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $user = Auth::user();
        if ($user){
            $user->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
            ]);

            return response()->json(['message' => 'User Profile Updated Successfully'], Response::HTTP_OK);

        }else{
            return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Add Phone Number
     *
     * Adds additional Phone Number to a users profile
     * @bodyParam phone_number string required PhoneNumber.
     * @bodyParam provider_id string required Teleco Provider ID.
     * @authenticated
     *
     * @param Request $request
     *
     */
    public function addPhoneNumber(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => 'required|unique:phone_numbers',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $user = Auth::user();
        $phone_number = preg_replace("/[^0-9]/", "", $request->get('phone_number'));
        $passcode = $this->passcode();
        $user->phone_numbers()->create([
            'provider_id'=>$request->provider_id ?? 1,
            'phone_number'=>$phone_number,
            'user_default'=>false,
            'is_active'=>false,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
            'passcode'=>$passcode
        ]);
        $details = [
            'name' => $user->first_name.' '.$user->last_name,
            'passcode' => $passcode,
            'to' => $user->email,
        ];
        Mail::send(new Passcode($details));
        $smsData = ['to'=>$phone_number, 'message'=>'Your Phone Verification Code is '.$passcode];
        SendSms::dispatch($smsData);
        return response()->json(['message' => 'Phone Number Added, awaiting validation'], Response::HTTP_OK);
    }

    /**
     * Verify Added Phone Number
     *
     * Verify passcode provided by the user on adding a new phone number.
     * @authenticated
     * @bodyParam phone_number string required Phone Number that received OTP.
     * @bodyParam passcode string required Passcode that was sent via SMS.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateAddedPhoneNumber(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => 'required|exists:phone_numbers',
                'passcode' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $phonenumber = PhoneNumber::where('phone_number','=', $request->get('phone_number'))->first();
        if ($phonenumber->phone_verified_at != null) {
            $phonenumber->update(['updated_at' => Carbon::now(), 'is_active'=>true]);
            return response()->json(['message' => 'PhoneNumber already verified'], Response::HTTP_OK);
        }
        if ($request->passcode == $phonenumber->passcode) {
            $phonenumber->update(['phone_verified_at' => Carbon::now(), 'is_active'=>true]);
            return response()->json(['message' => 'PhoneNumber verified Successfully'], Response::HTTP_OK);
        }
        else {
            return response()->json(['message' => 'Invalid passcode'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Set Default Phone Number
     *
     * Mark Registered PhoneNumber as Default.
     * @authenticated
     * @bodyParam phone_number string required Phone Number that received OTP.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setDefaultPhoneNumber(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'phone_number' => 'required|exists:phone_numbers',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $user = Auth::user();
        $phonenumber = $user->phone_numbers()->where(['phone_number'=>preg_replace("/[^0-9]/", "", $request->get('phone_number')),'is_active'=>true])->first();
        if ($phonenumber->phone_verified_at == null) {
            return response()->json(['message' => 'Phone Number must be verified to be set as default'], Response::HTTP_OK);
        }else{
            $user->default_phone_number()->update(['user_default'=>false, 'updated_at'=>Carbon::now()]);
            $phonenumber->update(['user_default'=>true, 'updated_at'=>Carbon::now()]);
            return response()->json(['message' => 'Default Phone Number set Successfully'], Response::HTTP_OK);
        }
    }


    /**
     * Delete Phone Number
     *
     * Delete registered Phone Number
     * @authenticated
     * @bodyParam phone_number string required Phone Number is to be deleted.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePhoneNumber(Request $request)
    {
        $validator = Validator::make(
        $request->all(),
        [
            'phone_number' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }

        $profile = Auth::user();
        if ($profile) {
            $phone_number = PhoneNumber::where('phone_number', '=', $request->phone_number)->first();
            if (!$phone_number){
                return response()->json(['message' => 'Phone Number not found'], Response::HTTP_NOT_FOUND);
            }else{
                $phone_number->delete();
                return response()->json(['message' => 'Phone Number has been deleted successfully'], Response::HTTP_OK);
            }
        } else {
            return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Delete Account
     *
     * Deactivates user account
     * @authenticated
     */
    public function deleteAccount()
    {
        $profile = Auth::user();
        if ($profile) {
            $profile->update(['is_active' => false]);
            //delete user access_tokens
            $profile->tokens->each(function ($token){
                $token->delete();
            });
            return response()->json(['message' => true, 'comment' => 'Account has been deleted'], Response::HTTP_OK);
        } else {
            return response()->json(['message' => false, 'comment' => 'Invalid user'], Response::HTTP_BAD_REQUEST);
        }
    }

    protected function passcode($min = 1000, $max = 9999)
    {
        return mt_rand($min, $max);
    }

    /**
     * @group User History
     *
     * APIs for user six months transactions
     * @authenticated
     */
    public function getMonthlyTransactionsData() {
        $user = Auth::user();
        if ($user) {
            $start = new DateTime('first day of this month - 5 months');
            $end   = new DateTime('this month');
            $interval  = new DateInterval('P1M');
            $date_period = new DatePeriod($start, $interval, $end);
            $months = array();
            $months_name = array();

            $month_name_array_dates = array();
            $month_name_array_dates_format = array();

            foreach($date_period as $dates) {
                array_push($months, $dates->format('m'));
                array_push($months_name, $dates->format('F').' '.$dates->format('Y'));
            }
            if ( ! empty( $months ) ) {
                foreach ( $months_name as $month  ) {
                    $day_mon_array = $this->getAllMonthsDays($month,$user);
                    array_push( $month_name_array_dates, $day_mon_array );
                }
                foreach ( $months_name as $month  ) {
                    array_push( $month_name_array_dates_format, $month );
                }
            }
            return response()->json(['message' => $month_name_array_dates], \Symfony\Component\HttpFoundation\Response::HTTP_OK);
        }
        else {
            return response()->json(['message' => false, 'comment' => 'Invalid user'], \Illuminate\Http\Response::HTTP_BAD_REQUEST);
        }


    }
    function getAllMonthsDays($month,$user){
        $month_no =  Carbon::parse($month)->format('m') ;
        $year = Carbon::now()->year;
        $days_array = Transaction::whereMonth( 'created_at',$month_no )
            ->whereYear('created_at', $year)
            ->where('status', true)
            ->where('user_id', $user->id)
            ->count();

        $days_array = array(
            'transactions' => $days_array,
            'month' => $month,
        );
        return $days_array;
    }
}
