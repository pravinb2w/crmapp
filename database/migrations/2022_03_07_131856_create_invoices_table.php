<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('deal_id')->comment('from deals');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('no action');
            $table->string( 'invoice_no');
            $table->date('issue_date');
            $table->date('due_date');
            $table->unsignedBigInteger('customer_id')->comment('from customers');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action');
            $table->text('address')->nullable();
            $table->string( 'email')->nullable();
            $table->decimal('subtotal')->nullable();
            $table->decimal('tax')->nullable();
            $table->decimal('discount')->nullable();
            $table->decimal('total')->nullable();
            $table->integer( 'status' )->comment('0-pending,1-approved')->default(0);
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('added_by')->comment('from usertable');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('updated_by')->comment('from usertable')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action');
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
        Schema::dropIfExists('invoices');
    }
}
