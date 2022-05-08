<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInvoiceIdToPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->unsignedBigInteger('invoice_id')->comment('from invoices')->nullable()->after('deal_id');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('no action');
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
            $table->dropForeign(['invoice_id']);
            $table->dropColumn('invoice_id');
        });
    }
}
