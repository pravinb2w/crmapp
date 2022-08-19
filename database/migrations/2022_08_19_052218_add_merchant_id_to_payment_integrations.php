<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantIdToPaymentIntegrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment_integrations', function (Blueprint $table) {
            $table->string('test_merchant_id')->after('enabled')->nullable();
            $table->string('live_merchant_id')->after('test_secret_key')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment_integrations', function (Blueprint $table) {
            $table->dropColumn('test_merchant_id');
            $table->dropColumn('live_merchant_id');
        });
    }
}
