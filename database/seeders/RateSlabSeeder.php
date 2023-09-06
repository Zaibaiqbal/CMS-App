<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RateSlabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rates = array();

        $count = -1;

        $rates[++$count] = ['start_weight' => 0, 'end_weight' => 250, 'rate' => 5,'created_at' => now(), 'updated_at' => now()];

        $rates[++$count] = ['start_weight' => 250, 'end_weight' => 500, 'rate' => 5,'created_at' => now(), 'updated_at' => now()];


        $rates[++$count] = ['start_weight' => 500, 'end_weight' => 750, 'rate' => 5,'created_at' => now(), 'updated_at' => now()];


        $rates[++$count] = ['start_weight' => 750, 'end_weight' => 900, 'rate' => 5,'created_at' => now(), 'updated_at' => now()];


        DB::table('rate_slabs')->insert($rates);

    }
}
