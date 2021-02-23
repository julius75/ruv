<?php

namespace Database\Seeders;

use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Provider::where('name', '=', 'Orange')->exists() and
            !Provider::where('name', '=', 'Moov')->exists() and
            !Provider::where('name', '=', 'Telecel')->exists())
        {
            DB::table('providers')->insert([
                ['name' => 'Orange',
                    'logo' => asset('providers/orange.jpeg'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'Moov',
                    'logo' => asset('providers/moov.jpeg'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
                ['name' => 'Telecel',
                    'logo' => asset('providers/telecel.jpeg'),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),],
            ]);
        }
    }
}
