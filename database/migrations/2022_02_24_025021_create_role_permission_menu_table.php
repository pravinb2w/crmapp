<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePermissionMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_permission_menu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permission_id')->comment('from roles');
            $table->foreign('permission_id')->references('id')->on('role_permissions')->onDelete('no action');
            $table->string('menu')->nullable();
            $table->string('is_view')->default('no')->comment('yes,no');
            $table->string('is_edit')->default('no')->comment('yes,no');
            $table->string('is_delete')->default('no')->comment('yes,no');
            $table->string('is_assign')->default('no')->comment('yes,no');
            $table->integer('status')->comment('0-inactive,1-active')->default(1);
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
        Schema::dropIfExists('role_permission_menu');
    }
}
