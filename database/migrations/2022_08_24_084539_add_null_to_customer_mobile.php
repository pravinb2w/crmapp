<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullToCustomerMobile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_mobile', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_mobile', function (Blueprint $table) {
            $table->unsignedBigInteger('added_by')->nullable(false)->change();
        });
    }
}
