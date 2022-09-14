<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDefaultPaymentToCompanySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('default_payment_id')->comment('from payment_integrations')->after('aws_access_key')->nullable();
            $table->foreign('default_payment_id')->references('id')->on('payment_integrations')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropForeign(['default_payment_id']);
            $table->dropColumn('default_payment_id');
        });
    }
}
