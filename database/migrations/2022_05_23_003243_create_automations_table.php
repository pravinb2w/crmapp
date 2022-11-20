<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->string('activity_type');
            $table->string('activity_title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('template_id')->comment('from email_templates')->nullable();
            $table->foreign('template_id')->references('id')->on('email_templates')->onDelete('no action');
            $table->integer('is_mail_to_customer')->default(0)->nullable();
            $table->integer('is_mail_to_team')->default(0)->nullable();
            $table->integer('is_notification_to_team')->default(0)->nullable();
            $table->text('notification_title')->nullable();
            $table->text('notification_message')->nullable();
            $table->integer('status')->default(0)->comment('1-active,0-inactive');
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
        Schema::dropIfExists('automations');
    }
}
