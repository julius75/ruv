<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDevice;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function test(){
        $users = User::whereHas('device')->get();
        $sent = false;
        foreach ($users as $user){
            $device = $user->device();
            if ($device){
                $push_message = "Testing Push Notifications: Welcome to RUV-BF";
                $this->send_firebase_push_notification($device->token, $push_message);
                $sent = true;
            }
        }
        return [$sent,$users];
    }

    function send_firebase_push_notification($token, $push_message)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

        $notification = [
            'title'=>'RUV-BF',
            'body' => $push_message,
            'sound' => true,
        ];

        $extraNotificationData = ["message" => $notification, "moredata" =>'Welcome to RUV-BF'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multiple token array
            'to'        => $token, //single token
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
        \Log::info("response got: ". json_encode($result));
    }
}
