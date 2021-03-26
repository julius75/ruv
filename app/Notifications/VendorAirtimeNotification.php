<?php

namespace App\Notifications;

use App\Jobs\VendorPushNotification;
use App\Models\Provider;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VendorAirtimeNotification extends Notification
{
    use Queueable;
    public $user;
    public $token;
    public $amount;
    public $provider;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $token
     * @param $amount
     * @param $provider
     */
    public function __construct($user, $token, $amount, $provider)
    {
        $this->user = $user;
        $this->token = $token;
        $this->amount = $amount;
        $this->provider = $provider;
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
        $push_message = "Please send  CFA. $this->amount of airtime to this user";
        VendorPushNotification::dispatch($this->token, $push_message);
        return [
            "type"=>"request-sent-to-vendor",
            "created_at"=>$this->user->created_at,
            "provider"=>$this->provider,
            "provider_id"=>Provider::where('name',$this->provider)->first()->id,
            "amount"=> $this->amount,
            'message'=>"Please send airtime of CFA.25 to 54345545 phone number."
        ];
    }
}
