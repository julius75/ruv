<?php

namespace App\Http\Resources;

use App\Models\MoovMoneyTransaction;
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
        if ($this->transactionable_type == OrangeAirtimeTransaction::class){
            return [
                'id' => $this->id,
                'reference_number' => $this->reference_number,
                'amount' => $this->amount,
                'phone_number' => $this->transactionable->customer_msisdn,
                'issued' => $this->transactionable->issued,
                'status' => $this->status,
                'user' => User::find($this->user_id,['id', 'first_name', 'last_name']),
                'provider' => Provider::find(1,['id', 'name', 'logo']),
                'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            ];
        }elseif ($this->transactionable_type == MoovMoneyTransaction::class){
            return [
                'id' => $this->id,
                'reference_number' => $this->reference_number,
                'amount' => $this->amount,
                'phone_number' => $this->transactionable->customer_msisdn,
                'issued' => $this->transactionable->issued,
                'status' => $this->status,
                'user' => User::find($this->user_id,['id', 'first_name', 'last_name']),
                'provider' => Provider::find(2,['id', 'name', 'logo']),
                'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i'),
            ];
        }
        else{
            return [];
        }
    }
}
