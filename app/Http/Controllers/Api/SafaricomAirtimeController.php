<?php

namespace App\Http\Controllers\Api;

use App\Events\InitiateSendJambopayAirtime;
use App\Http\Controllers\Controller;
use App\Jobs\SendJambopayAirtime;
use Illuminate\Http\Request;

class SafaricomAirtimeController extends Controller
{
    public function initiate_sending_airtime(array $data)
    {
        //pass data to the event
//        event(new InitiateSendJambopayAirtime($data));
        dispatch(new SendJambopayAirtime($data))->delay(now()->addSeconds(5));

    }
}
