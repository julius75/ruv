<?php

namespace App\Http\Controllers\Api;
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
 * @group Orange Notifications
 * * @authenticated
 * APIs for orange notifications
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

}
