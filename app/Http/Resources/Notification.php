<?php

namespace App\Http\Resources;

use App\Models\OrangeAirtimeTransaction;
use App\Models\Provider;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $user = Auth::user();
        $details = [];
        if ($this->type == 'App\Notifications\AirtimePurchaseNotification')
        {
            $details["details"] =  $this->data;
        }
        elseif ($this->type == 'App\Notifications\VendorAirtimeNotification')
        {
            $details["details"] =  $this->data;
        }
        return [$details];
    }
}
