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
        $users = User::all();
        foreach($users as $user){
            $date = Carbon::today()->subDays(rand(0, 20));
            $phone_number = $user->default_phone_number();
            $orange = new OrangeAirtimeTransaction();
            $orange->phone_number_id = $phone_number->id;
            $orange->customer_msisdn =  $phone_number->phone_number;
            $orange->amount = mt_rand(100,1000);
            $orange->otp = mt_rand(1000,99999);
            $orange->reference_number = config('app.orange_money_airtime_reference_number');
            $orange->ext_txn_id = Carbon::now()->format('YmdHis');
            $orange->issued = true;
            $orange->status = 200;
            $orange->message = 'Cher client, le OTP utilise nexiste pas. Veuillez appeler le 127.';
            $orange->transID = 'OM210204.1141.A36479';
            $orange->type = config('app.orange_money_airtime_type');
            $orange->created_at = $date;
            $orange->updated_at = $date;
            $orange->save();

            Transaction::create([
                'user_id'=>$user->id,
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
