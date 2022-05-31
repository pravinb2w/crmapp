<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Alexia",
            // 'email' => Str::random(10).'@gmail.com',
            'email' => 'admin@yopmail.com',
            'password' => Hash::make('password'),
            'company_id' => 1,
            'status' => 1
        ],[
            'name' => "Developer",
            // 'email' => Str::random(10).'@gmail.com',
            'email' => 'dev@yopmail.com',
            'password' => Hash::make('dev@2022'),
            'company_id' => 1,
            'status' => 1,
            'is_dev' => 1,
        ]);
    }
}
