<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->enum('status', ['pending_payment', 'processing', 'ready', 'completed', 'on_hold'])->default('pending_payment');
            $table->enum('transport', ['personal', 'kurier', 'postOffice']);
            $table->enum('payment', ['bank', 'cash', 'creditCart']);
            $table->string('creditCard');
            $table->string('cvc');
            $table->string('expiry');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
