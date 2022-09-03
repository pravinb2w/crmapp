<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectedByToCustomerDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('rejectedBy')->nullable()->comment('from usertable')->after('rejectedAt');
            $table->foreign('rejectedBy')->references('id')->on('users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_documents', function (Blueprint $table) {
            $table->dropForeign(['rejectedBy']);
            $table->dropColumn('rejectedBy');
        });
    }
}
