<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPageMetaDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_page_meta_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('page_id')->comment('from landingpage');
            $table->foreign('page_id')->references('id')->on('landing_pages')->onDelete('no action');
            $table->string('name');
            $table->text('description');
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
        Schema::dropIfExists('landing_page_meta_details');
    }
}
