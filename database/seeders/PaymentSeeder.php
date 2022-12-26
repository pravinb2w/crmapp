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
            [
                'company_id' => 1,
                'gateway' => 'razorpay',
                'enabled' => 'live',
                'test_access_key' => 'rzp_test_dyikKZgBPcPuwl',
                'test_secret_key' => 'oBfi1I5volTVxcjWQekBVYHL',
                'live_merchant_id' => '',
                'live_access_key'   => 'rzp_live_TYNMFFxwtecB00',
                'live_secret_key'   => 'rnLkR8gkbg0x6QKpzSFBJm21kCZ2IqQ2',
                'status' => 1
            ],
            [
                'company_id' => 1,
                'gateway' => 'ccavenue',
                'enabled' => 'live',
                'test_access_key' => '',
                'test_secret_key' => '',
                'live_merchant_id' => '976366',
                'live_access_key'   => 'AVOQ87JF30BA32QOAB',
                'live_secret_key'   => '81E0204433275CCA7E007B7781545845',
                'status' => 1
            ],
            [
                'company_id' => 1,
                'gateway' => 'payumoney',
                'enabled' => 'live',
                'test_access_key' => '',
                'test_secret_key' => '',
                'live_merchant_id' => 'pkTb5Q',
                'live_access_key'   => 'pkTb5Q',
                'live_secret_key'   => 'rnLkR8gkbg0x6QKpzSFBJm21kCZ2IqQ2',
                'status' => 1
            ],
        ]);
    }
}
