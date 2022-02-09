<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('role_id')->comment('from roles');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('no action');
            $table->unsignedBigInteger('role_menu_id')->comment('from role menus');
            $table->foreign('role_menu_id')->references('id')->on('role_menus')->onDelete('no action');
            $table->integer('is_view')->default(0)->comment('0-no, 1-yes');
            $table->integer('is_edit')->default(0)->comment('0-no, 1-yes');
            $table->integer('is_delete')->default(0)->comment('0-no, 1-yes');
            $table->integer('is_export')->default(0)->comment('0-no, 1-yes');
            $table->integer('is_print')->default(0)->comment('0-no, 1-yes');
            $table->integer('status')->comment('0-inactive,1-active');
            $table->unsignedBigInteger('added_by')->comment('from usertable');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('updated_by')->comment('from usertable')->nullable();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('no action');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_permissions');
    }
}
