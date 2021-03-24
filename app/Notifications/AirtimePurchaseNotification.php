<?php

namespace App\Notifications;

use App\Jobs\SendPushNotification;
use App\Listeners\SendAirtimePurchaseNotification;
use App\Models\Provider;
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
    public $amount;
    public $refNumber;
    public $provider;
    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $token
     * @param $amount
     * @param $refNumber
     */
    public function __construct($user, $token, $amount, $refNumber, $provider)
    {
        $this->user = $user;
        $this->token = $token;
        $this->amount = $amount;
        $this->refNumber = $refNumber;
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
                $push_message = "You will receive your $this->provider airtime of CFA. $this->amount.";
                SendPushNotification::dispatch($this->token, $push_message);
                return [
                    "type"=>"request-assigned-to-vendor",
                    "created_at"=>$this->user->created_at,
                    "ref_number"=>$this->refNumber,
                    "provider"=>$this->provider,
                    "provider_id"=>Provider::where('name',$this->provider)->first()->id,
                    "amount"=> $this->amount,
                    'message'=>"You will receive your $this->provider airtime of CFA. $this->amount."
                ];
    }
}
