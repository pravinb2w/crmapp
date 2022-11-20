<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageSocialMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_social_medias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->integer('page_id');
            $table->string('name');
            $table->string('link');
            $table->string('icon');
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
        Schema::dropIfExists('landing_page_social_medias');
    }
}
