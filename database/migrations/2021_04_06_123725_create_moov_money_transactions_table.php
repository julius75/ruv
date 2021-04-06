<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoovMoneyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moov_money_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->index()->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('phone_number_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('vendor_phone_number_id')->nullable();
            $table->string('customer_msisdn');
            $table->string('vendor_msisdn');
            $table->decimal('amount', 8,2);
            $table->boolean('status')->default(false);
            $table->boolean('issued')->default(false);
            $table->string('remarks')->nullable();
            $table->string('message')->nullable();
            $table->json('response')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('phone_number_id')
                ->references('id')
                ->on('phone_numbers')
                ->onDelete('set null');

            $table->foreign('vendor_id')
                ->references('id')
                ->on('phone_numbers')
                ->onDelete('set null');

            $table->foreign('vendor_phone_number_id')
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
        Schema::dropIfExists('moov_money_transactions');
    }
}
