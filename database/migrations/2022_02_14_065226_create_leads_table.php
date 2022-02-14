<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->comment('from customertable');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action');
            $table->string('lead_title')->nullable();
            $table->string('lead_subject')->nullable();
            $table->string('lead_description')->nullable();
            $table->double('lead_value')->nullable();
            $table->string('lead_currency')->nullable();
            $table->unsignedBigInteger('lead_type_id')->comment('from lead_types')->nullable();
            $table->foreign('lead_type_id')->references('id')->on('lead_types')->onDelete('no action');
            $table->unsignedBigInteger('lead_source_id')->comment('from lead_sources')->nullable();
            $table->foreign('lead_source_id')->references('id')->on('lead_sources')->onDelete('no action');
            $table->timestamp('assigned_at')->nullable();
            $table->unsignedBigInteger('assigned_to')->comment('from usertable')->nullable();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('assinged_by')->comment('from usertable')->nullable();
            $table->foreign('assinged_by')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('visible_to')->comment('from roles')->nullable();
            $table->foreign('visible_to')->references('id')->on('roles')->onDelete('no action');
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
        Schema::dropIfExists('leads');
    }
}
