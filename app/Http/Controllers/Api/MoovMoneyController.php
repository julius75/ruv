<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendPushNotification;
use App\Models\MoovMoneyTransaction;
use App\Models\Option;
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
use Illuminate\Support\Facades\Validator;


class MoovMoneyController extends Controller
{
    public function initiateMoovPayment(Request $request)
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

            $initiate_request = $this->send_request_to_moov_api($refNumber, $phone_number, $provider, $request->amount);

            $moov = new MoovMoneyTransaction();
            $moov->request_id = $refNumber;
            $moov->user_id = $user->id;
            $moov->phone_number_id = $phone_number_id;
            $moov->vendor_id = $vendor->id;
            $moov->merchant_id = $merchant->id;
            $moov->vendor_phone_number_id = $vendor_phone_number->id;
            $moov->customer_msisdn =  $phone_number;
            $moov->vendor_msisdn =  $vendor_phone_number->phone_number;
            $moov->amount = $request->amount;
            $moov->remarks = "Buy RUV Airtime";
            $moov->message = "Buy $provider->name airtime worth $request->amount from RUV-BF";
            $moov->issued = false;
            if ($initiate_request['code'] == 200){
                $moov->status = true;
            }else{
                $moov->status = false;
            }
            $moov->response = $initiate_request['response'];
            $moov->created_at = Carbon::now();
            $moov->updated_at = Carbon::now();
            $moov->save();

            Transaction::create([
                'reference_number'=>$refNumber,
                'user_id'=>$user->id,
                'vendor_id'=>$vendor->id,
                'merchant_id'=>$merchant->id,
                'amount'=>$request->amount,
                'status'=>false,
                'transactionable_id'=>$moov->id,
                'transactionable_type'=>MoovMoneyTransaction::class,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now()
            ]);
            DB::commit();
            //send push notification.....if no device no notifications
            $device = $user->device()->first();
            $user->notify(new AirtimePurchaseNotification($user, $request->amount, $refNumber, $provider->name));
            if ($device){
                $push_message = "You will receive your Orange airtime of CFA. $moov->amount.";
                SendPushNotification::dispatch($device->token, $push_message)->delay(10);
                return response()->json(['message'=>'Transaction Assigned and notification sent'], Response::HTTP_OK);
            }
            else{
                return response()->json(['message'=>'Transaction Assigned'], Response::HTTP_OK);
            }
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['message'=>'Something Went Wrong on our side, try again later','exp'=>$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function send_request_to_moov_api($refNumber, $phone_number, $provider, $amount)
    {
        $login = config('app.moov_cash_username');
        $password = config('app.moov_cash_password');
        $url = 'https://196.28.245.227/tlcfzc_gw/api/gateway/3pp/transaction/process';
        $post_data = json_encode([
            "request-id"=>$refNumber,
            "destination"=> '226'.substr($phone_number, -8),//"22670839661",
            "amount"=> $amount,
            "remarks"=> "Buy RUV Airtime",
            "message"=> "Buy $provider->name airtime worth $amount from RUV-BF",
            "extended-data"=> []
        ]);
        $hash = hash('sha256',config('app.moov_cash_username').$post_data);
        $headers = array(
            'Authorization: Basic '. base64_encode($login.':'.$password),
            'command-id: mror-transaction-ussd',
            'hash: '.$hash,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $response = curl_exec($ch);
        $errors = curl_error($ch);
        $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        error($returnCode.$errors);
        return ['code'=>$returnCode, 'response'=>$response];
    }
}
