<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDealPiplinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_piplines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->comment('from companysettings')->nullable();
            $table->foreign('company_id')->references('id')->on('company_settings')->onDelete('no action');
            $table->unsignedBigInteger('deal_id')->comment('from deals');
            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('no action');
            $table->unsignedBigInteger('stage_id')->comment('from deal_stages');
            $table->foreign('stage_id')->references('id')->on('deal_stages')->onDelete('no action');
            $table->string( 'status' )->comment('completed,pending')->nullable();
            $table->timestamp('completed_at')->nullable();
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
        Schema::dropIfExists('deal_piplines');
    }
}
