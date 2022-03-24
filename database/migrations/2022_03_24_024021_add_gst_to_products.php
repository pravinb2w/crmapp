<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGstToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('cgst')->nullable()->default(0)->after('hsn_no');
            $table->decimal('sgst')->nullable()->default(0)->after('cgst');
            $table->decimal('igst')->nullable()->default(0)->after('sgst');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('cgst');
            $table->dropColumn('sgst');
            $table->dropColumn('igst');
        });
    }
}
