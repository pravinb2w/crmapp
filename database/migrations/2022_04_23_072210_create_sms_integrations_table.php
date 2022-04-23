<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms_integrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from company');
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->string('twilio_sid')->nullable();
            $table->string('twilio_auth_token')->nullable();
            $table->string('twilio_number')->nullable();
            $table->string('enable_twilio')->nullable()->comment('yes,no');
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
        Schema::dropIfExists('sms_integrations');
    }
}
