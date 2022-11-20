<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('customer_id')->comment('from customers')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->unsignedBigInteger('document_id')->comment('from kyc_document_types')->nullable();
            $table->foreign('document_id')->references('id')->on('kyc_document_types')->onDelete('no action');
            $table->timestamp('uploadAt')->nullable();
            $table->timestamp('approvedAt')->nullable();
            $table->unsignedBigInteger('approvedBy')->nullable()->comment('from usertable');
            $table->foreign('approvedBy')->references('id')->on('users')->onDelete('no action');
            $table->timestamp('rejectedAt')->nullable();
            $table->text('reject_reason')->nullable();
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_documents');
    }
}
