<?php

namespace Database\Seeders;
use App\Models\PhoneNumber;
use App\Models\Provider;
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
            if (!$user->default_phone_number())
            {
                PhoneNumber::create([
                    'user_id' => $user->id,
                    'provider_id' => Provider::inRandomOrder()->first()->id,
                    'user_default' => true,
                    'is_active' => true,
                    'phone_number' => '226'.mt_rand(100000000, 999999999),
                    'phone_verified_at'=>Carbon::now(),
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                    'passcode'=>mt_rand(1000, 9999),
                ]);
            }
        }
    }
}
