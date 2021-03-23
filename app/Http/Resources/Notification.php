<?php

namespace App\Http\Resources;

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
            $message = $this->data;

            $phone_numbers =$user->phone_numbers()->select(['phone_number','is_active', 'user_default', 'provider_id'])->get();
            $phone_numbers->map(function ($phone_number){
                $phone_number->provider=Provider::find($phone_number->provider_id, ['id', 'name', 'logo']);
                unset($phone_number->provider_id);
            });
            $provider= $phone_numbers[0]["provider"]["name"];
            $provider_id= $phone_numbers[0]["provider"]["id"];

            $details["details"] = $message;
            $details["provider"] = $provider;
            $details["provider_id"] = $provider_id;

        }
        return [
            $details,
        ];
    }
}
