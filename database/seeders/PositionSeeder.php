<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PositionSeeder extends Seeder
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
                'content' => 'mytask',
                'position' => 'left',
                'company_id' => 1
            ],
            [
                'content' => 'alltask',
                'position' => 'bottom-left',
                'company_id' => 1
            ],
            [
                'content' => 'closingweek',
                'position' => 'right',
                'company_id' => 1
            ],
            [
                'content' => 'mytask',
                'position' => 'bottom-right',
                'company_id' => 1
            ]
        ];
        DB::table('dashboard_orders')->insert($ins);
    }
}
