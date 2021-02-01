<?php

namespace Database\Seeders;
use App\Models\PhoneNumber;
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
        PhoneNumber::create([
            'user_id' => 1,
            'phone_number' => '1234567890',
        ]);
    }
}
