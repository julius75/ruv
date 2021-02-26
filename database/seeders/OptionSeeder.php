<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orange_airtime_option = Option::where('key', '=','initiate_orange_airtime_customer_ussd')->first();
        if (!$orange_airtime_option){
            Option::create([
                'key'=>'initiate_orange_airtime_customer_ussd',
                'value'=>'*144*4*7*%s*%s*%d#'
            ]);
        }
    }
}
