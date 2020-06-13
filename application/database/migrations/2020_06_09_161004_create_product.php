<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->integer('category_id')->index('category_id')->nullable();
            $table->integer('unit_id')->index('unit_id')->nullable();
            $table->string('name')->index('product_name')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->default('product/default.png')->nullable();
            $table->integer('qty')->default(0)->nullable();
            $table->text('prices')->nullable();
            $table->integer('online')->nullable();
            $table->decimal('price_online',15,2)->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('products');
    }
}
