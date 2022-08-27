<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChatLinksToOrganizationLinks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->text('whatsapp_chat_link')->nullable()->after('instagram_url');
            $table->text('instagram_chat_link')->nullable()->after('whatsapp_chat_link');
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
            $table->dropColumn('whatsapp_chat_link');
            $table->dropColumn('instagram_chat_link');
        });
    }
}
