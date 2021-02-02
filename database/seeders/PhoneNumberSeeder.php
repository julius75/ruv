<?php

namespace Database\Seeders;
use App\Models\PhoneNumber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class PhoneNumberSeeder extends Seeder
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
            PhoneNumber::create([
                'user_id' => $user->id,
                'provider_id' => null,
                'phone_number' => '226'.mt_rand(100000000, 999999999),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'passcode'=>mt_rand(1000, 9999),
            ]);
        }
    }
}
