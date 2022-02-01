<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanySubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subscription_id')->comment('from subscriptions');
            $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('no action');
            $table->unsignedBigInteger('company_id')->comment('from company');
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->date('startAt');
            $table->date('endAt');
            $table->double('total_amount');
            $table->text('description')->nullable();
            $table->integer('status')->comment('0-inactive,1-active,2-expired,3-cancelled');
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
        Schema::dropIfExists('company_subscriptions');
    }
}
