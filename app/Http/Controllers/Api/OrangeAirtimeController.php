<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendPushNotification;
use App\Models\Option;
use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\AirtimePurchaseNotification;
use App\Notifications\BundlePurchaseNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class OrangeAirtimeController extends Controller
{
    public function initiateOrangeMoney($request)
    {
        $user = Auth::user();
        $phone_number = PhoneNumber::where('phone_number', '=', $request->phone_number)->first();
        $provider = Provider::where('id', '=', $request->provider_id)->first();
        if ($phone_number){
            $phone_number_id = $phone_number->id;
            $phone_number = $phone_number->phone_number;
        }else{
            $phone_number_id = null;
            $phone_number = $request->phone_number;
        }
        $refNumber = generateTransactionRefNumber($request->provider_id);
//        DB::beginTransaction();
//        try{
            $vendor = User::find(roundRobinVendor($request->provider_id));
        $payment_provider_id =  Provider::select('id')->where('name', 'Orange')->get();

        $merchant = User::role('vendor')->whereHas('phone_numbers',function ($q) use ($payment_provider_id) {
                $q->where('provider_id', '=', $payment_provider_id);
            })->first();

            $vendor_phone_number = $vendor->phone_numbers()->where('provider_id', '=', $request->provider_id)->first();
            //$merchant_phone_number = $merchant->phone_numbers()->where('provider_id', '=', $request->provider_id)->first();
        $merchant_phone_number = $merchant->phone_numbers()->where('provider_id', '=', $payment_provider_id)->first();

        $orange = new OrangeAirtimeTransaction();
            $orange->reference_number = $refNumber;
            $orange->user_id = $user->id;
            $orange->phone_number_id = $phone_number_id;
            $orange->vendor_id = $vendor->id;
            $orange->merchant_id = $merchant->id;
            $orange->vendor_phone_number_id = $vendor_phone_number->id;
            $orange->customer_msisdn =  $phone_number;
            $orange->vendor_msisdn =  $vendor_phone_number->phone_number;
            $orange->amount = $request->amount;
            $orange->provider_id = $request->provider_id;
            $orange->issued = false;
            $orange->created_at = Carbon::now();
            $orange->updated_at = Carbon::now();
            $orange->save();

            Transaction::create([
                'reference_number'=>$refNumber,
                'user_id'=>$user->id,
                'vendor_id'=>$vendor->id,
                'merchant_id'=>$merchant->id,
                'amount'=>$request->amount,
                'status'=>false,
                'transactionable_id'=>$orange->id,
                'transactionable_type'=>OrangeAirtimeTransaction::class,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
//            DB::commit();
            $ussd = Option::where('key','=','initiate_orange_airtime_customer_ussd')->first()->value;
            $ussd = sprintf($ussd, substr($merchant_phone_number->phone_number,-8), $orange->reference_number, $orange->amount); //'*144*4*7* %s * %s * %c #'
            //send push notification.....if no device no notifications
            $device = $user->device()->first();
            $user->notify(new AirtimePurchaseNotification($user, $request->amount, $refNumber, $provider->name));
            if ($device){
                $push_message = "You will receive your Orange airtime of CFA. $orange->amount.";
                SendPushNotification::dispatch($device->token, $push_message)->delay(10);
                return response()->json(['message'=>'Transaction Assigned and notification sent', 'ussd'=>$ussd, 'user'=>Auth::id()], Response::HTTP_OK);
            }
            else{
                return response()->json(['message'=>'Transaction Assigned', 'ussd'=>$ussd, 'user_id'=>$orange->user_id], Response::HTTP_OK);
            }
//        }catch (\Exception $exception){
//            DB::rollBack();
//            return response()->json(['message'=>'Something Went Wrong on our side, try again later','exp'=>$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
//        }
    }
    public function initiateOrangeMoneyBundle($request)
    {
        $user = Auth::user();
        $phone_number = PhoneNumber::where('phone_number', '=', $request->phone_number)->first();
        $provider = Provider::where('id', '=', $request->provider_id)->first();
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
            $merchant = User::role('vendor')->whereHas('phone_numbers',function ($q) use ($provider) {
                $q->where('provider_id', '=', $provider->id);
            })->first();
            $vendor_phone_number = $vendor->phone_numbers()->where('provider_id', '=', $request->provider_id)->first();
            $merchant_phone_number = $merchant->phone_numbers()->where('provider_id', '=', $request->provider_id)->first();
            $orange = new OrangeAirtimeTransaction();
            $orange->reference_number = $refNumber;
            $orange->user_id = $user->id;
            $orange->phone_number_id = $phone_number_id;
            $orange->vendor_id = $vendor->id;
            $orange->merchant_id = $merchant->id;
            $orange->vendor_phone_number_id = $vendor_phone_number->id;
            $orange->customer_msisdn =  $phone_number;
            $orange->vendor_msisdn =  $vendor_phone_number->phone_number;
            $orange->amount = $request->amount;
            $orange->provider_id = $request->provider_id;
            $orange->issued = false;
            $orange->created_at = Carbon::now();
            $orange->updated_at = Carbon::now();
            $orange->save();

            Transaction::create([
                'reference_number'=>$refNumber,
                'user_id'=>$user->id,
                'vendor_id'=>$vendor->id,
                'merchant_id'=>$merchant->id,
                'amount'=>$request->amount,
                'status'=>false,
                'bundles'=>true,
                'transactionable_id'=>$orange->id,
                'transactionable_type'=>OrangeAirtimeTransaction::class,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            DB::commit();
            $ussd = Option::where('key','=','initiate_orange_airtime_customer_ussd')->first()->value;
            $ussd = sprintf($ussd, substr($merchant_phone_number->phone_number,-8), $orange->reference_number, $orange->amount); //'*144*4*7* %s * %s * %c #'
            //send push notification.....if no device no notifications
            $device = $user->device()->first();
            $user->notify(new BundlePurchaseNotification($user, $request->amount, $refNumber, $provider->name));
            if ($device){
                $push_message = "You will receive your Orange Bundles of CFA. $orange->amount.";
                SendPushNotification::dispatch($device->token, $push_message)->delay(10);
                return response()->json(['message'=>'Transaction Assigned and notification sent', 'ussd'=>$ussd, 'user'=>Auth::id()], Response::HTTP_OK);
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
