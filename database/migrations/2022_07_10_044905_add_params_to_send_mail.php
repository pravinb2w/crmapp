<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParamsToSendMail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('send_mail', function (Blueprint $table) {
            $table->text('params')->after('email_type')->nullable();
            $table->string('to')->after('params')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('send_mail', function (Blueprint $table) {
            $table->dropColumn('params');
            $table->dropColumn('to');
        });
    }
}