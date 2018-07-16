<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('basket_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->mediumText('order_price')->nullable();
            $table->string('status',30)->nullable();
            $table->integer('order_no')->nullable();

            $table->string('name',50)->nullable();
            $table->string('address',200)->nullable();
            $table->string('phone',15)->nullable();
            $table->string('m_phone',15)->nullable();
            $table->string('payment_method')->nullable();
            $table->integer('installments')->nullable();

            $table->string('token')->nullable();

            $table->timestamps();

            $table->unique('basket_id');
            $table->foreign('basket_id')->references('id')->on('baskets')->onDelete('cascade');

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
