<?php

namespace App\Http\Resources;

use App\Models\PhoneNumber;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class VendorTransaction extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $phone_number = PhoneNumber::where('user_id', '=', $this->user_id)->first();
        $provider = Provider::where('id', '=', $phone_number->provider_id)->first();

        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'status' => $this->status,
            'phone_number' => $phone_number->phone_number,
            'provider_id' => $provider->id,
            'provider' => $provider->name,
            'provider_logo' => $provider->logo,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            'approved' => $this->approved,
        ];
    }
}
