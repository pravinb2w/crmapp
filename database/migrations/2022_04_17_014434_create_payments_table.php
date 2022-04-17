<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string( 'payment_mode')->comment('online, offline');
            $table->unsignedBigInteger('customer_id')->comment('from customertable');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action');
            $table->unsignedBigInteger('deal_id')->comment('from dealtable')->nullable();
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('no action');
            $table->double('amount');
            $table->string( 'payment_method')->comment('cash, card, cheque, imps, upi');
            $table->string( 'cheque_no')->nullable();
            $table->date( 'cheque_date')->nullable();
            $table->string( 'reference_no')->nullable();
            $table->string( 'upi_id')->nullable();
            $table->string( 'card_no')->nullable();
            $table->string('payment_status')->comment('pending, paid, failed');
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
            $table->unsignedBigInteger('added_by')->comment('from usertable');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
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
        Schema::dropIfExists('payments');
    }
}
