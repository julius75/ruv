<?php

namespace App\Notifications;

use App\Jobs\SendPushNotification;
use App\Listeners\SendAirtimePurchaseNotification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AirtimePurchaseNotification extends Notification
{
    use Queueable;
    public $user;
    public $token;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $token
     */
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
                $push_message = "You will receive your Airtime shortly: RUV-BF";
                SendPushNotification::dispatch($this->token, $push_message);
                return [
                    "type"=>"Credit purchase assigned vendor",
                    "created_at"=>$this->user->created_at,
                    'message'=>"You have successfully purchased 200mb. Your current balance is now 500Mb."
                ];
    }
}
