<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_no')->unique()->nullable()->after('password');
            $table->text('image')->nullable()->after('mobile_no');
            $table->unsignedBigInteger('role_id')->comment('from rolestable')->after('image')->nullable();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action');;
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->after('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
           
            $table->dropColumn('mobile_no');
            $table->dropColumn('image');
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
            $table->dropColumn('company_id');

        });
    }
}
