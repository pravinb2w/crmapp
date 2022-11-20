<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->text('notes');
            $table->unsignedBigInteger('lead_id')->comment('from leads')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads')->onDelete('no action');
            $table->unsignedBigInteger('customer_id')->comment('from leads')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('no action');
            $table->unsignedBigInteger('user_id')->comment('from users')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('no action');
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
        Schema::dropIfExists('notes');
    }
}
