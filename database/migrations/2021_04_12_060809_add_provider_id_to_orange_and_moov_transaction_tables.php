<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProviderIdToOrangeAndMoovTransactionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('moov_money_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onDelete('restrict');
        });

        Schema::table('orange_airtime_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('moov_money_transactions', function (Blueprint $table) {
            $table->dropColumn('provider_id');
        });
        Schema::table('orange_airtime_transactions', function (Blueprint $table) {
            $table->dropColumn('provider_id');
        });
    }
}
