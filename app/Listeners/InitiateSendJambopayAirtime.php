<?php

namespace App\Listeners;

use App\Jobs\SendJambopayAirtime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class InitiateSendJambopayAirtime
{
    public $data;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        dispatch(new SendJambopayAirtime($event->data))->delay(now()->addMinute());
    }
}
