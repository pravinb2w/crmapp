<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefixSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefix_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from company')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->string('prefix_field');
            $table->string('prefix_value');
            $table->integer('status')->default(1)->comment('0-inactive,1-active');
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
        Schema::dropIfExists('prefix_settings');
    }
}
