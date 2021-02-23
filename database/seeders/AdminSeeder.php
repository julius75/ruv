<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = Admin::where('email', '=', 'admin@deveint.com')->exists();
        if (!$exists){
            $admin = Admin::create([
                'name'=>'Deveint Admin',
                'username'=>'deveint',
                'email'=>'admin@deveint.com',
                'phone_number'=>'254725730055',
                'password'=>Hash::make('secretpassword'),
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
                'status'=>true
            ]);
            $admin->assignRole('admin');
        }
    }
}
