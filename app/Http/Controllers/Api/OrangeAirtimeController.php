<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\AirtimePurchaseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * @group Orange Airtime
 * @authenticated
 * APIs for orange airtime purchase
 *
 */
class OrangeAirtimeController extends Controller
{
    /**
     * Initiate a Payment (Customer Facing)
     *
     * Send payment request to orange API
     *
     * @bodyParam provider_id integer required Phone Number Provider.
     * @bodyParam phone_number string required Orange Recipient Phone Number.
     * @bodyParam amount string required Orange Airtime Amount.
     *
     * @authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function initiatePayment(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'phone_number' => 'required',
                'amount' => 'required|integer|min:10|max:10000',
                'provider_id' => 'required|exists:providers,id',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }
        $user = Auth::user();
        $phone_number = PhoneNumber::where('phone_number', '=', $request->phone_number)->first();
        if ($phone_number){
            $phone_number_id = $phone_number->id;
            $phone_number = $phone_number->phone_number;
        }else{
            $phone_number_id = null;
            $phone_number = $request->phone_number;
        }
        $refNumber = generateTransactionRefNumber($request->provider_id);
        DB::beginTransaction();
            try{
                $vendor = User::find(roundRobinVendor($request->provider_id));
                $vendor_phone_number = $vendor->phone_numbers()->where('provider_id', '=', $request->provider_id)->first();
                $orange = new OrangeAirtimeTransaction();
                $orange->reference_number = $refNumber;
                $orange->user_id = $user->id;
                $orange->phone_number_id = $phone_number_id;
                $orange->vendor_id = $vendor->id;
                $orange->vendor_phone_number_id = $vendor_phone_number->id;
                $orange->customer_msisdn =  $phone_number;
                $orange->vendor_msisdn =  $vendor_phone_number->phone_number;
                $orange->amount = $request->amount;
                $orange->issued = false;
                $orange->created_at = Carbon::now();
                $orange->updated_at = Carbon::now();
                $orange->save();

                Transaction::create([
                    'reference_number'=>$refNumber,
                    'user_id'=>$user->id,
                    'vendor_id'=>$vendor->id,
                    'amount'=>$request->amount,
                    'status'=>false,
                    'transactionable_id'=>$orange->id,
                    'transactionable_type'=>OrangeAirtimeTransaction::class,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now()
                ]);
                DB::commit();
                $ussd = Option::where('key','=','initiate_orange_airtime_customer_ussd')->first()->value;
                $ussd = sprintf($ussd, substr($vendor_phone_number->phone_number,-8), $orange->reference_number, $orange->amount); //'*144*4*7* %s * %s * %c #'
                $users = User::whereHas('device')->where('id', Auth::id())->get();

                //send push notification.....if no device no notifications
                if ($users){
                    foreach ($users as $user){
                        $device = $user->device()->first();
                        if ($device){
                            $user->notify(new AirtimePurchaseNotification($user,$device->token));
                            return response()->json(['message'=>'Transaction Assigned and notification sent', 'ussd'=>$ussd, 'user'=>Auth::id()], Response::HTTP_OK);
                        }
                    }
                }

                else{
                    return response()->json(['message'=>'Transaction Assigned', 'ussd'=>$ussd, 'user_id'=>$orange->user_id], Response::HTTP_OK);

                }


            }catch (\Exception $exception){
                DB::rollBack();
                return response()->json(['message'=>'Something Went Wrong on our side, try again later','exp'=>$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    }
}
