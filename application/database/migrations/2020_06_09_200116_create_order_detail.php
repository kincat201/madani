<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->integer('order_id')->index('order_id')->nullable();
            $table->integer('product_id')->index('product_id')->nullable();
            $table->string('remark')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('price',15,2)->nullable();
            $table->decimal('hpp',15,2)->nullable();
            $table->decimal('total_price',15,2)->nullable();
            $table->decimal('total_hpp',15,2)->nullable();
            $table->integer('deleted')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
