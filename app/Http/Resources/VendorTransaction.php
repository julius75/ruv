<?php

namespace App\Http\Resources;

use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Provider;
use App\Models\User;
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
        if ($this->transactionable_type == 'App\Models\OrangeAirtimeTransaction'){
            $provider = Provider::find(1);
            $orangetransactions = OrangeAirtimeTransaction::where('reference_number',$this->reference_number)->first();
            return [
                'id' => $this->id,
                'reference_number' => $this->reference_number,
                'user_id' => $this->user_id,
                'vendor_id' => $this->vendor_id,
                'amount' => $this->amount,
                'phone_number' => $orangetransactions['customer_msisdn'],
                'provider' => $provider,
                'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
                'issued' => $this->issued,
            ];
        }

    }
}
