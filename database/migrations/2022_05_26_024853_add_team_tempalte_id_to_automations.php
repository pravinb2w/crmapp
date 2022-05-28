<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamTempalteIdToAutomations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automations', function (Blueprint $table) {
            $table->unsignedBigInteger('team_template_id')->comment('from email_templates')->nullable()->after('is_mail_to_customer');
            $table->foreign('team_template_id')->references('id')->on('email_templates')->onDelete('no action');
            $table->unsignedBigInteger('added_by')->comment('from users')->after('status');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('automations', function (Blueprint $table) {
            $table->dropForeign(['team_template_id']);
            $table->dropColumn('team_template_id');
        });
    }
}
