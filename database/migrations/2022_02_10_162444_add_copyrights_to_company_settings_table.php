<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCopyrightsToCompanySettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('smtp_host')->after('instagram_url')->nullable();
            $table->integer('smtp_port')->after('smtp_host')->nullable();
            $table->string('smtp_user')->after('smtp_port')->nullable();
            $table->string('smtp_password')->after('smtp_user')->nullable();
            $table->string('copyrights')->after('smtp_password')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn('smtp_host');
            $table->dropColumn('smtp_port');
            $table->dropColumn('smtp_user');
            $table->dropColumn('smtp_password');
            $table->dropColumn('copyrights');
        });
    }
}
