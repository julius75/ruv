<?php

namespace Database\Seeders;

use App\Models\OrangeAirtimeTransaction;
use App\Models\PhoneNumber;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::role('user')->get();
        foreach($users as $user){
            $date = Carbon::today()->subDays(rand(0, 20));
            $phone_number = $user->default_phone_number();
            $vendor = User::find(roundRobinVendor($phone_number->provider_id));
            $vendor_phone_number = $vendor->default_phone_number();
            $orange = new OrangeAirtimeTransaction();
            $orange->reference_number = generateTransactionRefNumber($phone_number->provider_id);
            $orange->user_id = $user->id;
            $orange->phone_number_id = $phone_number->id;
            $orange->vendor_id = $vendor->id;
            $orange->vendor_phone_number_id = $vendor_phone_number->id;
            $orange->customer_msisdn =  $phone_number->phone_number;
            $orange->vendor_msisdn =  $vendor_phone_number->phone_number;
            $orange->amount = mt_rand(100,1000);
            $orange->issued = true;
            $orange->created_at = $date;
            $orange->updated_at = $date;
            $orange->save();

            Transaction::create([
                'reference_number'=>$orange->reference_number,
                'user_id'=>$user->id,
                'vendor_id'=>$orange->vendor_id,
                'amount'=>$orange->amount,
                'status'=>true,
                'transactionable_id'=>$orange->id,
                'transactionable_type'=>OrangeAirtimeTransaction::class,
                'created_at'=>$date,
                'updated_at'=>$date
            ]);
        }
    }
}
