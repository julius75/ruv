<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $smsData;

    /**
     * Create a new job instance.
     *
     * @param $smsData
     */
    public function __construct($smsData)
    {
        $this->smsData = $smsData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $msg = $this->smsData['message'];
        $phoneNumber = $this->smsData['to'];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.lesmsbus.com:7170/ines.smsbus/smsbusMt?to='.$phoneNumber.'&text='.urlencode($msg).'&id='.config('app.sms_bus_id').'&from='.config('app.sms_bus_sender_id'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 5,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: JSESSIONID=60A5B8A8643C7CB6A01532CD41EBAF8C'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        //echo $response;
    }
}
