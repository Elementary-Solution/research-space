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
            $table->string('user_id')->nullable();
            $table->string('variation_id')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('subscription_duration')->default(1);
            $table->string('discount_id')->default(1);
            $table->string('order_status')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('order_date')->nullable();
            $table->string('coupon_discount')->nullable();
            $table->string('order_total')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
