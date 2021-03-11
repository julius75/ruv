<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendJambopayAirtime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $provider = $this->data['provider'];
        $recipientPhone = $this->data['recipientPhone'];
        $amount = $this->data['amount'];
        if ($amount > 20){
            $amount = 20;
        }

        $token = $this->getAgentAuthToken();

//provider validation, gets valid provider IDs and validates input
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://services.jambopay.co.ke/jambopayservices/api/payments/getCreditDetails?stream=credit",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: bearer ".$token,
                "app_key: D9C9BE43-7A96-EA11-9462-A1B43CAC8373"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            //redirect to failed
            \Log::error("validation failed".$err);

        }
        $resp =  json_decode($response, true);
        $operators = $resp['Operators'];
        $valid_ids = [];
        $selected = [];
        foreach($operators as $op){
            array_push($valid_ids, (int)$op['ID']);

            if((int)$provider == (int)$op['ID']){
                array_push($selected, $op['Name']);
            }
        }
        if(!in_array($provider, $valid_ids)){
            \Log::error("Selected Provider Not Found");
        }

        $app_key = "D9C9BE43-7A96-EA11-9462-A1B43CAC8373";
        $stream = "credit";
        $TransactionID = null;

//submit request for credit to jp
        $submit_req_curl = curl_init();
        curl_setopt_array($submit_req_curl, array(
            CURLOPT_URL => "http://services.jambopay.co.ke/jambopayservices/api/payments/POST",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "Stream=".$stream."&PhoneNumber=".$recipientPhone."&Amount=".$amount."&PaymentTypeID=1&CircleCode=1&OperatorCode=".$provider."&ProductCode=RV&Denomination=".$amount."&Quantity=1",
            CURLOPT_HTTPHEADER => array(
                "Authorization: bearer ".$token,
                "app_key: ".$app_key,
                "Content-Type: application/x-www-form-urlencoded",
            ),
        ));

        $sub_req_response = curl_exec($submit_req_curl);
        $sub_req_auth_err = curl_error($submit_req_curl);
        curl_close($submit_req_curl);
        if ($sub_req_auth_err) {
            //redirect to failed
            \Log::error("submission to JP failed");
        }
        else {
            $resp =  json_decode($sub_req_response, true);
            $ID = $resp['ID'];
            $OperatorName = $resp['OperatorName'];
            $TransactionID = $resp['TransactionID'];
        }

//commit the transaction
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://services.jambopay.co.ke/jambopayservices/api/payments/PUT",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "Stream=credit&TransactionID=".$TransactionID."&PhoneNumber=".$recipientPhone."&Tendered=".$amount."&PaymentTypeID=1",
            CURLOPT_HTTPHEADER => array(
                "Authorization: bearer ".$token,
                "app_key: ".$app_key,
                "Content-Type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        \Log::info($response);
    }

    function getAgentAuthToken(){
        $token = null;
        //authenticate to receive token from Airtime API
        $auth_curl = curl_init();
        curl_setopt_array($auth_curl, array(
            CURLOPT_URL => "http://services.jambopay.co.ke/jambopayservices/token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "grant_type=agency&username=markets@jambopay.com&password=Jpay2020%23%23",
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/x-www-form-urlencoded",
            ),
        ));
        $auth_response = curl_exec($auth_curl);
        $auth_err = curl_error($auth_curl);
        curl_close($auth_curl);
        if ($auth_err) {
            \Log::error("agent authentication failed. CURL ERROR: ".$auth_err);
        }
        else {
            $resp =  json_decode($auth_response, true);
            $token = $resp['access_token'];
        }
        return $token;
    }
}
