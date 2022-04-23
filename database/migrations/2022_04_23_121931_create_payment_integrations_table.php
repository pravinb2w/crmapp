<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_integrations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from company');
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->string('gateway')->nullable();
            $table->string('enabled')->default('test')->comment('test,live');
            $table->string('test_access_key')->nullable();
            $table->string('test_secret_key')->nullable();
            $table->string('live_access_key')->nullable();
            $table->string('live_secret_key')->nullable();
            $table->text('success_page')->nullable();
            $table->text('fail_page')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('payment_integrations');
    }
}
