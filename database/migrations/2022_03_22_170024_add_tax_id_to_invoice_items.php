<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTaxIdToInvoiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->unsignedBigInteger('tax_group_id')->comment('from tax_groups')->after('tax')->nullable();
            $table->foreign('tax_group_id')->references('id')->on('tax_groups')->onDelete('no action');
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
            $table->dropContraint(['tax_group_id']);
            $table->dropColumn('tax_group_id');
        });
    }
}
