<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $token;
    public $push_message;

    /**
     * Create a new job instance.
     *
     * @param $token
     * @param $push_message
     */
    public function __construct($token, $push_message)
    {
        $this->token = $token;
        $this->push_message = $push_message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $notification = [
            'title'=>'RUV-BF',
            'body' => $this->push_message,
            'sound' => true,
        ];
        $extraNotificationData = ["message" => $notification, "moredata" =>'Welcome to RUV-BF'];
        $fcmNotification = [
            //'registration_ids' => $tokenList, //multiple token array
            'to'        => $this->token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData,
            'android' => ["priority"=>"high"],
            'apns' => ["headers"=>[ "apns-priority"=>"5"]],
        ];
        $headers = [
            'Authorization: key='.config('app.firebase_server_key'),
            'Content-Type: application/json'
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
        info("response got: ". json_encode($result));
    }
}
