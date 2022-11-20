<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcitivityCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acitivity_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('activity_id')->comment('from activities');
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('no action');
            $table->string('comments');
            $table->unsignedBigInteger('added_by')->comment('from users');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
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
        Schema::dropIfExists('acitivity_comments');
    }
}
