<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('subscription_name');
            $table->string('subscription_period');
            $table->integer('no_of_clients')->nullable();
            $table->integer('no_of_employees')->nullable();
            $table->integer('no_of_leads')->nullable();
            $table->integer('no_of_deals')->nullable();
            $table->integer('no_of_pages')->nullable();
            $table->integer('no_of_email_templates')->nullable();
            $table->string('bulk_import')->nullable();
            $table->string('database_backup')->nullable();
            $table->string('work_automation')->nullable();
            $table->string('telegram_bot')->nullable();
            $table->string('sms_integration')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('business_whatsapp')->nullable();
            $table->double('amount');
            $table->integer('status')->default(1)->comment('0-inactive,1-active');
            $table->unsignedBigInteger('added_by')->comment('from usertable');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('updated_by')->comment('from usertable');
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
        Schema::dropIfExists('subscriptions');
    }
}
