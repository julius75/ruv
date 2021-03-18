<?php
/**
 * Copyright (c) 2021. <mukhamikaranja@gmail.com>
 */

use \App\Models\Transaction;
use \Illuminate\Support\Arr;
use \App\Models\User;
use \App\Models\Option;
use \App\Models\Provider;

function transactionRefNumberExists(string $number)
{
    return Transaction::where('reference_number', '=', $number)->exists();
}

function generateTransactionRefNumber(int $provider_id){
    $provider=Provider::find($provider_id);
    if ($provider->name == 'Orange'){
        $prefix='OR';
    }elseif ($provider->name == 'Moov'){
        $prefix='MO';
    }elseif ($provider->name == 'Telecel'){
        $prefix='TE';
    }else{
        $prefix='RUV';
    }
    $transactionNumber = $prefix.mt_rand(1000, 9999);
    while (transactionRefNumberExists($transactionNumber)){
        $transactionNumber = $prefix.mt_rand(1000, 9999);
    }
    return $transactionNumber;
}

function roundRobinVendor(int $provider_id)
{
    $vendors = User::role('vendor-user')->where('online','=', true)
        ->whereHas('phone_numbers', function ($q) use($provider_id){
            $q->where('provider_id', '=', $provider_id);
        })
        ->orderBy('id')->select('id')->get()->toArray();
    $provider_name = Provider::find($provider_id)->name;
    $vendors = Arr::flatten($vendors);
    $len = count($vendors);
    $last_vendor = Option::where('key', $provider_name.'_last_vendor_id');
    if ($last_vendor->exists()) {
        $last_vendor_id = $last_vendor->first()->value;
        for ($i = 0; $i < $len; $i++) {
            if ($last_vendor_id == $vendors[$i]) {
                $next = $i + 1;
                if ($next === $len) {
                    $next = 0;
                }
                $next_vendor_id = $vendors[$next];
                Option::updateOrCreate(['key' => $provider_name.'_last_vendor_id'],
                    ['key' => $provider_name.'_last_vendor_id', 'value' => $next_vendor_id]);
                return $next_vendor_id;
            }
        }
    } else {
        $vendor = User::role('vendor-user')->where('online','=', true)
            ->whereHas('phone_numbers', function ($q) use($provider_id){
            $q->where('provider_id', '=', $provider_id);
        })->first();
        Option::create(['key' => $provider_name.'_last_vendor_id', 'value' => $vendor->id]);
        return $vendor->id;
    }
}
