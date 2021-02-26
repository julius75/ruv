<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Transaction;
use App\Models\User;
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
 */
class OrangeAirtimeController extends Controller
{
    /**
     * Initiate a Payment (Customer Facing)
     *
     * Send payment request to orange API
     * @bodyParam provider_id integer required Phone Number Provider.
     * @bodyParam phone_number string required Orange Recipient Phone Number.
     * @bodyParam amount string required Orange Airtime Amount.
     * @authenticated
     * @param Request $request
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

                return response()->json(['message'=>'Transaction Assigned', 'ussd'=>$ussd], Response::HTTP_OK);

            }catch (\Exception $exception){
                DB::rollBack();
                return response()->json(['message'=>'Something Went Wrong on our side, try again later','exp'=>$exception], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    }

    /**
     * Submit payment request
     *
     * Send payment request to orange API
     * @bodyParam phone_number string required Orange Recipient Phone Number.
     * @bodyParam amount string required Orange Airtime Amount.
     * @bodyParam otp string required OTP Received from Orange Money USSD.
     *
     */
    /**
    public function buyAirtime(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'phone_number' => 'required',
                'amount' => 'required|integer|min:10|max:10000',
                'otp' => 'required',
            ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], Response::HTTP_BAD_REQUEST);
        }

        $recipient_phone_number = substr($request->get('phone_number'),-8);
        $ext_txn_id = Carbon::now()->format('YmdHis');
        $data['phone_number']= $request->get('phone_number');
        $data['amount']= $request->get('amount');
        $data['otp']= $request->get('otp');
        $data['recipient_phone_number']= $recipient_phone_number;
        $data['ext_txn_id']= $ext_txn_id;
        try{
            //submit request
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://apiom.orange.bf:9007/payment',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="UTF-8"?>
                                    <COMMAND>
                                    <TYPE>'.config('app.orange_money_airtime_type').'</TYPE>
                                    <customer_msisdn>'.$recipient_phone_number.'</customer_msisdn>
                                    <merchant_msisdn>'.config('app.orange_money_airtime_msisdn').'</merchant_msisdn>
                                    <api_username>'.config('app.orange_money_airtime_username').'</api_username>
                                    <api_password>'.config('app.orange_money_airtime_password').'</api_password>
                                    <amount>'.$request->get('amount').'</amount>
                                    <PROVIDER>101</PROVIDER>
                                    <PROVIDER2>101</PROVIDER2>
                                    <PAYID>12</PAYID>
                                    <PAYID2>12</PAYID2>
                                    <otp>'.$request->get('otp').'</otp>
                                    <reference_number>'.config('app.orange_money_airtime_reference_number').'</reference_number>
                                    <ext_txn_id>'.$ext_txn_id.'</ext_txn_id>
                                    </COMMAND>',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/xml'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            $xml = simplexml_load_string('<response>'.$response.'</response>');
            $json = json_encode($xml);
            $array = json_decode($json, true);
            return $this->storeAirtimeTransaction($array, $data);
        }catch (\Exception $exception)
        {
            Log::error($exception->getMessage());
            return response()->json(['message'=>'Something Went Wrong on our side, try again later'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    protected function storeAirtimeTransaction($array, $data){
        $phoneNumberID = null;
        $phoneNumber = PhoneNumber::where('phone_number', '=', $data['phone_number'])->first();
        if ($phoneNumber){
            $phoneNumberID = $phoneNumber->id;
        }
        $payment_status = false;
        $payment_message  = 'Airtime Purchase Failed';
        if ((int)$array['status']== 200){
            $payment_status = true;
            $payment_message  = 'Airtime Purchase was Successful';
        }

        $orange = new OrangeAirtimeTransaction();
        $orange->phone_number_id = $phoneNumberID;
        $orange->customer_msisdn = $data['recipient_phone_number'];
        $orange->amount = $data['amount'];
        $orange->otp = $data['otp'];
        $orange->reference_number = config('app.orange_money_airtime_reference_number');
        $orange->ext_txn_id = $data['ext_txn_id'];
        $orange->issued = $payment_status;
        $orange->status = $array['status'];
        $orange->message = $array['message'];
        $orange->transID = $array['transID'];
        $orange->type = config('app.orange_money_airtime_type');
        $orange->created_at = Carbon::now();
        $orange->updated_at = Carbon::now();
        $orange->save();

        Transaction::create([
            'user_id'=>Auth::id(),
            'amount'=>$orange->amount,
            'status'=>$payment_status,
            'transactionable_id'=>$orange->id,
            'transactionable_type'=>OrangeAirtimeTransaction::class,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()
        ]);
        return response()->json(['message'=>$orange->message, 'payment_status'=>$payment_message], Response::HTTP_OK);
    }
     *
     */
}
