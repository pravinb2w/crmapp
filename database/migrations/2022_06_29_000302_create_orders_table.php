<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->decimal('amount');
            $table->unsignedBigInteger('customer_id')->comment('from customertable');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action');
            $table->string('product_code')->nullable();
            $table->string('payment_gateway')->comment('razorpay,ccavenue,payu');
            $table->text('description')->nullable();
            $table->string('status')->comment('pending,completed');
            $table->unsignedBigInteger('added_by')->nullable()->comment('from usertable');
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
        Schema::dropIfExists('orders');
    }
}
