<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLeadAccessToCompanySettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->string('lead_access')->nullable()->after('invoice_terms');
            $table->string('deal_access')->nullable()->after('lead_access');
            $table->string('workflow_automation')->nullable()->after('deal_access');
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
            $table->dropColumn('lead_access');
            $table->dropColumn('deal_access');
            $table->dropColumn('workflow_automation');
        });
    }
}
