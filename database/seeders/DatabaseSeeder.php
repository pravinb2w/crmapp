<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $this->call([
            SettingsSeeder::class,
            PrefixSeeder::class,
            UserSeeder::class,
            LandingPageSeeder::class,
            TaxGroupSeeder::class,
            PositionSeeder::class,
            PaymentSeeder::class,
            SubscriptionSeeder::class,
            SmsSeeder::class,
            CountrySeeder::class,
            StatusSeeder::class
        ]);
    }
}
