<?php

namespace App\Http\Controllers\Api;
use App\Notifications\VendorAirtimeNotification;
use Illuminate\Http\Response;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\Controller;
use App\Jobs\SendJambopayAirtime;
use App\Jobs\SendPushNotification;
use App\Models\User;
use App\Models\UserDevice;
use App\Notifications\AirtimePurchaseNotification;
use Illuminate\Http\Request;
use App\Http\Resources\Notification;

use Illuminate\Support\Facades\Auth;

/**
 * @group Notifications
 * * @authenticated
 * APIs for mobile app notifications
 */

class NotificationController extends Controller
{
    /**
     * Fetch All Notifications
     *@authenticated
     *
     */
    public function all(){
        $user = Auth::user();
        $notifications = $user->notifications()->orderBy('created_at','desc')->paginate(20);
        return Notification::collection($notifications);
    }
    /**
     * Fetch All Unread Notifications
     *@authenticated
     *
     */
    public function unread()
    {
        $notifications = Auth::user()->unreadNotifications;
        if (count($notifications) > 0)
        {
            $notifications->markAsRead(); //if unread notifications mark them as read
            return Notification::collection($notifications);
        }
        else
        {
            return response()->json([
                "success" => true,
                "message" => "No new notifications."
            ], 200);
        }

    }

    public function send_vendor_notification(){
        $user = Auth::user();
        if ($user->hasRole('vendor-user')){
            $device = $user->device()->first();
            if ($device){
                $amount = 20;
                $provider = 'Orange';
                $user->notify(new VendorAirtimeNotification($user,$device->token,$amount,$provider));
            }
        }
        else{
            return ['message'=>'Response not sent...something went wrong'];

        }

    }

}
