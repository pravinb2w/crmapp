<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('order_id')->after('deal_id')->nullable();
            $table->string('razorpay_id')->after('order_id')->nullable();
            $table->string('name')->after('razorpay_id')->nullable();
            $table->string('email')->after('name')->nullable();
            $table->string('contact_no')->after('email')->nullable();
            $table->string('currency')->after('contact_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('order_id');
            $table->dropColumn('razorpay_id');
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('contact_no');
            $table->dropColumn('currency');
        });
    }
}
