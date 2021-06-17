<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BundlesDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bundles_details')->insert([
            ['provider_id' => 1,
                'description' =>'Subscribe for 10 MBs',
                'code' =>'*103*100#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 40 MBs',
                'code' =>'*103*225#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 150 MBs',
                'code' =>'*103*525#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 500 MBs',
                'code' =>'*103*1025#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],

            ['provider_id' => 1,
                'description' =>'Subscribe for 200 MBs+50SMS',
                'code' =>'*506*200#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 1GB+100SMS',
                'code' =>'*506*500#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 2GB+200SMS',
                'code' =>'*506*1000#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],

            ['provider_id' => 1,
                'description' =>'Subscribe for 5 MBs',
                'code' =>'*103*5*1#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 25 MBs',
                'code' =>'*103*5*2#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 120 MBs',
                'code' =>'*103*5*3#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],

            ['provider_id' => 1,
                'description' =>'Subscribe for 100 MB weekly',
                'code' =>'*130*500#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 400 MB weekly',
                'code' =>'*130*1000#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 1GB weekly',
                'code' =>'*103*2000#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 500 MB monthly',
                'code' =>'*130*500#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 1GB monthly',
                'code' =>'*130*2500#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 2GB monthly',
                'code' =>'*103*4000#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 5GB monthly',
                'code' =>'*130*8000#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 1,
                'description' =>'Subscribe for 10GB monthly',
                'code' =>'*103*15000#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
            ['provider_id' => 3,
                'description' =>'telecel',
                'code' =>' *160*1*2#',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),],
        ]);
    }
}
