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
            ],
            [
                'content' => 'alltask',
                'position' => 'bottom-left',
            ],
            [
                'content' => 'closingweek',
                'position' => 'right',
            ],
            [
                'content' => 'mytask',
                'position' => 'bottom-right',
            ]
        ];
        DB::table('dashboard_orders')->insert($ins);
    }
}
