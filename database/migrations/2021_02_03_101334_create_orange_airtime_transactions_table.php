<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrangeAirtimeTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orange_airtime_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('phone_number_id')->nullable();
            $table->string('customer_msisdn');
            $table->decimal('amount', 8,2);
            $table->string('otp')->nullable();
            $table->boolean('issued')->default(false);
            $table->string('reference_number');
            $table->string('ext_txn_id');
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->string('transID')->nullable();
            $table->string('type');
            $table->timestamps();

            $table->foreign('phone_number_id')
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
        Schema::dropIfExists('orange_airtime_transactions');
    }
}
