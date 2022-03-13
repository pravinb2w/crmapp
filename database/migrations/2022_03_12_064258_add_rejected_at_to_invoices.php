<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRejectedAtToInvoices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->timestamp('rejected_at')->nullable()->after('approved_at');
            $table->timestamp('pending_at')->nullable()->after('rejected_at');
            $table->unsignedBigInteger('approved_by')->comment('from users')->nullable()->after('pending_at');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('no action');
            $table->unsignedBigInteger('rejected_by')->comment('from users')->nullable()->after('approved_by');
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('no action');
            $table->text('reject_reason')->nullable()->after('rejected_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('rejected_at');
            $table->dropColumn('pending_at');
            $table->dropColumn('approved_by');
            $table->dropColumn('rejected_by');
            $table->dropColumn('reject_reason');
        });
    }
}
