<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->text("page_title");
            $table->text("page_logo");
            $table->text("permalink");
            $table->string('page_type', 100)->nullable();  
            $table->text("mail_us");
            $table->text("call_us");
            $table->text("contact_us");
            $table->integer('status')->default(1);
            $table->softDeletes();
            $table->longText("other_tags")->nullable();
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
        Schema::dropIfExists('landing_pages');
    }
}
