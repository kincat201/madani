<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderMachine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_machines', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->integer('order_id')->index('order_id')->nullable();
            $table->integer('machine_id')->index('machine_id')->nullable();
            $table->dateTime('completeDate')->nullable();
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
        Schema::dropIfExists('order_machines');
    }
}
