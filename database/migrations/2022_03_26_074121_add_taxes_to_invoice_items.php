<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxesToInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropColumn('tax');
           
            $table->decimal('cgst')->nullable()->after('discount');
            $table->decimal('sgst')->nullable()->after('cgst');
            $table->decimal('igst')->nullable()->after('sgst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropColumn('cgst');
            $table->dropColumn('sgst');
            $table->dropColumn('igst');
        });
    }
}
