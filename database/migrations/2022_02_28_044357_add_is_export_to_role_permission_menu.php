<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsExportToRolePermissionMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_permission_menu', function (Blueprint $table) {
            $table->string( 'is_export' )->default('no')->after('is_assign');
            $table->string('is_filter')->default('no')->after('is_export');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_permission_menu', function (Blueprint $table) {
            $table->dropColumn('is_export');
            $table->dropColumn('is_filter');

        });
    }
}
