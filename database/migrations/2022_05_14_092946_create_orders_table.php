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
            $table->id();
            $table->string('code', 10);
            $table->foreignId('user_id');
            $table->integer('total');
            $table->foreignId('coupon_id')->nullable();
            $table->double('discount')->default(0);
            $table->string('payment');
            $table->string('image')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('coupon_id')->references('id')->on('coupons');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('menu_id');
            $table->foreignId('size_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('menu_id')->references('id')->on('menu');
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
