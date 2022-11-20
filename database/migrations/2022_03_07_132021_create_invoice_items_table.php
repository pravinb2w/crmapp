<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('invoice_id')->comment('from invoices');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('no action');
            $table->unsignedBigInteger('product_id')->comment('from products');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('no action');
            $table->text('description')->nullable();
            $table->decimal('qty')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('amount')->nullable();
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
        Schema::dropIfExists('invoice_items');
    }
}
