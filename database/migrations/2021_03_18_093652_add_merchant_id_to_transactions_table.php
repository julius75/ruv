<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMerchantIdToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id')->nullable();

            $table->foreign('merchant_id')
                ->references('id')
                ->on('phone_numbers')
                ->onDelete('set null');
        });

        Schema::table('orange_airtime_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('merchant_id')->nullable();

            $table->foreign('merchant_id')
                ->references('id')
                ->on('phone_numbers')
                ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('merchant_id');
        });

        Schema::table('orange_airtime_transactions', function (Blueprint $table) {
            $table->dropColumn('merchant_id');
        });
    }
}
