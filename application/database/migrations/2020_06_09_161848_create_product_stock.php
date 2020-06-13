<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->integer('product_id')->index('product_id')->nullable();
            $table->integer('order_detail_id')->index('order_detail_id')->nullable();
            $table->string('types')->nullable();
            $table->integer('qty_before')->nullable();
            $table->integer('qty_after')->nullable();
            $table->integer('deleted')->default(0)->nullable();
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
        Schema::dropIfExists('product_stocks');
    }
}
