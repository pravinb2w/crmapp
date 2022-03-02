<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_id')->comment('from deals')->nullable();
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('no action');
            $table->text('document');
            $table->string('document_name')->nullable();
            $table->integer('status')->default(1)->comment('0-inactive, 1-active');
            $table->unsignedBigInteger('added_by')->comment('from usertable');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
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
        Schema::dropIfExists('deal_documents');
    }
}
