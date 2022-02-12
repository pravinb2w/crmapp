<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToCompanySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('site_email')->after('site_name')->nullable();
            $table->string('site_phone')->after('site_email')->nullable();
            $table->text('address')->nullable()->after('site_phone');
            $table->string('office_time')->nullable()->after('address');
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
            $table->dropColumn('site_email');
            $table->dropColumn('site_phone');
            $table->dropColumn('address');
            $table->dropColumn('office_time');
        });
    }
}
