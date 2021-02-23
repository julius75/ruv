<?php

namespace Database\Seeders;

use App\Models\Provider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->count(10)->create();
        $users = User::all();
        foreach ($users as $user){
            $user->assignRole('user');
        }
        if (User::role('vendor')->get()->count() == 0){
            //create a vendor for each provider
            $providers = Provider::all();
            if (count($providers) > 0){
                foreach($providers as $provider){
                    $vendor = User::create([
                        'first_name' => $provider->name,
                        'last_name' => 'Vendor',
                        'email' => 'vendor'.$provider->id.'@deveint.com',
                        'email_verified_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                        'is_active' => true,
                        'online'=>true,
                        'password' => Hash::make('secretpassword'),
                        'remember_token' => Str::random(20),
                    ]);
                    $vendor->assignRole('vendor');
                    $vendor->phone_numbers()->create([
                        'provider_id'=>$provider->id,
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
}
