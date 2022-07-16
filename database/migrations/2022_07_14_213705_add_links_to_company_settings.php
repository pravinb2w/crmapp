<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinksToCompanySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('mentorship_link')->nullable()->after('last_deal_order');
            $table->string('telegram_bot')->nullable()->after('mentorship_link');
            $table->string('testimonial_link')->nullable()->after('telegram_bot');
            $table->string('youtube_learning_link')->nullable()->after('testimonial_link');
            $table->string('telegram_link')->nullable()->after('youtube_learning_link');
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
            $table->dropColumn('mentorship_link');
            $table->dropColumn('telegram_bot');
            $table->dropColumn('testimonial_link');
            $table->dropColumn('youtube_learning_link');
            $table->dropColumn('telegram_link');
        });
    }
}