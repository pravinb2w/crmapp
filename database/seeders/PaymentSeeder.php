<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_integrations')->insert([
            'company_id' => 1,
            'gateway' => 'razorpay',
            'enabled' => 'no',
            'test_access_key' => 'rzp_test_dyikKZgBPcPuwl',
            'test_secret_key' => 'oBfi1I5volTVxcjWQekBVYHL',

        ]);
    }
}
