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
            $table->string('reference_number')->index()->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('phone_number_id')->nullable();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->unsignedBigInteger('vendor_phone_number_id')->nullable();
            $table->string('customer_msisdn');
            $table->string('vendor_msisdn');
            $table->decimal('amount', 8,2);
            $table->boolean('issued')->default(false);
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
        Schema::dropIfExists('orange_airtime_transactions');
    }
}
