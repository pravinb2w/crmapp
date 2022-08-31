<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDocumentToCustomerDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_documents', function (Blueprint $table) {
            $table->text('document')->nullable()->after('document_id');
            $table->enum('status', ['pending', 'approved', 'rejected', 'cancelled'])->default('pending')->after('document');
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
            $table->dropColumn('document');
            $table->dropColumn('status');
        });
    }
}
