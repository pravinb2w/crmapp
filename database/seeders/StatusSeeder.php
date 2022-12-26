<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
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
                'company_id' => '1',
                'type' => 'activity',
                'status_name' => 'Yet to Start',
                'order' => '1',
                'color' => '#ff0000',
                'is_active' => '1',
            ],
            [
                'company_id' => '1',
                'type' => 'activity',
                'status_name' => 'In Progress',
                'order' => '2',
                'color' => '#ff8800',
                'is_active' => '1',
            ],
            [
                'company_id' => '1',
                'type' => 'activity',
                'status_name' => 'Completed',
                'order' => '3',
                'color' => '#73ff00',
                'is_active' => '1',
            ],
            [
                'company_id' => '1',
                'type' => 'task',
                'status_name' => 'Yet to Start',
                'order' => '1',
                'color' => '#ff0000',
                'is_active' => '1',
            ],
            [
                'company_id' => '1',
                'type' => 'task',
                'status_name' => 'In Progress',
                'order' => '2',
                'color' => '#ff7e05',
                'is_active' => '1',
            ],
            [
                'company_id' => '1',
                'type' => 'task',
                'status_name' => 'Completed',
                'order' => '3',
                'color' => '#4dff00',
                'is_active' => '1',
            ]
        ];

        DB::table('status')->insert($ins);
    }
}
