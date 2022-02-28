<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('from customertable');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action');
            $table->string('deal_title')->nullable();
            $table->string('deal_description')->nullable();
            $table->double('deal_value')->nullable();
            $table->string('deal_currency')->nullable();
            $table->unsignedBigInteger('lead_id')->comment('from leads')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('no action');
            $table->unsignedBigInteger('current_stage_id')->comment('from deal_stages')->nullable();
            $table->foreign('current_stage_id')->references('id')->on('deal_stages')->onDelete('no action');
            $table->string( 'stage_status')->nullable();
            $table->date( 'expected_completed_date')->nullable();
            $table->decimal('product_total')->nullable();
            $table->timestamp('assigned_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->comment('from usertable')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('assinged_by')->comment('from usertable')->nullable();
            $table->foreign('assinged_by')->references('id')->on('users')->onDelete('no action');
            $table->integer('status')->default(0)->comment('0-inactive,1-active, 2-done');
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
        Schema::dropIfExists('deals');
    }
}
