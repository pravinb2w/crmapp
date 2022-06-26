<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserNameToSmsIntegrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sms_integrations', function (Blueprint $table) {
            $table->string('sms_type')->after('company_id')->nullable()->comment('new_registration,payment_remainder,success_payment,etc');
            $table->string('user_name')->after('sms_type')->nullable();
            $table->string('api_key')->after('user_name')->nullable();
            $table->text('template')->after('api_key')->nullable();
            $table->string('sender_id')->after('template')->nullable();
            $table->string('template_id')->after('sender_id')->nullable()->comment('tid');
            $table->string('type')->after('template_id')->nullable();
            $table->string('variables')->after('type')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_integrations', function (Blueprint $table) {
            $table->dropColumn('sms_type');
            $table->dropColumn('user_name');
            $table->dropColumn('api_key');
            $table->dropColumn('template');
            $table->dropColumn('sender_id');
            $table->dropColumn('template_id');
            $table->dropColumn('type');
            $table->dropColumn('variables');
        });
    }
}
