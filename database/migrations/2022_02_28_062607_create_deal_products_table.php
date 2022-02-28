<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('deal_id')->comment('from deals');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('no action');
            $table->unsignedBigInteger('product_id')->comment('from products');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action');
            $table->string('product_name')->nullable();
            $table->decimal('price')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('amount')->nullable();
            $table->decimal('discount')->nullable();
            $table->string('unit')->nullable();
            $table->integer('status')->default(1)->comment('0-inactive, 1-active');
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
        Schema::dropIfExists('deal_products');
    }
}
