<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSendTypeToSendMail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('send_mail', function (Blueprint $table) {
            $table->string('send_type')->comment('customer,user')->nullable()->after('to');
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
            $table->dropColumn('send_type');
        });
    }
}
