<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDealNullToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('deal_id')->nullable()->change();
            $table->string('order_no')->after('deal_id')->nullable();
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->unsignedBigInteger('deal_id')->nullable(false)->change();
            $table->unsignedBigInteger('added_by')->nullable(false)->change();
            $table->dropColumn('order_no');
        });
    }
}
