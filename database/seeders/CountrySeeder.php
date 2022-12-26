<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ins = [
            [
                'country_name' => 'India',
                'dial_code' => '91', 
                'company_id' => 1,
                'country_code' => 'IN',
                'currency' => 'Rs',
                'added_by' => '1',
                'status' => '1'
            ],
        ];

        DB::table('countries')->insert($ins);
    }
}
