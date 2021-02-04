<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @group Orange Airtime
 * @authenticated
 * APIs for orange airtime purchase
 */
class OrangeAirtimeController extends Controller
{
    /**
     * Submit payment request
     *
     * Send payment request to orange API
     * @bodyParam phone_number string required Orange Recipient Phone Number.
     * @bodyParam amount string required Orange Airtime Amount.
     * @bodyParam otp string required OTP Received from Orange Money USSD.
     *
     */
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

        $phoneNumberID = PhoneNumber::where('phone_number', '=', $request->get('phone_number'))->first()->id;
        if (!$phoneNumberID){
            $phoneNumberID = null;
        }

        $orange = new OrangeAirtimeTransaction();
        $orange->phone_number_id = $phoneNumberID;
        $orange->customer_msisdn = $recipient_phone_number;
        $orange->amount = $request->get('amount');
        $orange->otp = $request->get('otp');
        $orange->reference_number = config('app.orange_money_airtime_reference_number');
        $orange->ext_txn_id = $ext_txn_id;
        $orange->status = $array['status'];
        $orange->message = $array['message'];
        $orange->transID = $array['transID'];
        $orange->type = config('app.orange_money_airtime_type');
        $orange->created_at = Carbon::now();
        $orange->updated_at = Carbon::now();
        $orange->save();

        $transaction = Transaction::create([
           'user_id'=>Auth::id(),
           'amount'=>$orange->amount,
           'status'=>false,
           'transactionable_id'=>$orange->id,
           'transactionable_type'=>OrangeAirtimeTransaction::class,
           'created_at'=>Carbon::now(),
           'updated_at'=>Carbon::now()
        ]);
        return response()->json([compact('orange', 'transaction'), Response::HTTP_OK]);
    }
}
