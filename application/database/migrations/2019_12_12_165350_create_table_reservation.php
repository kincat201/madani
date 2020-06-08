<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableReservation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->integer('userId')->nullable();
            $table->string('title')->nullable();
            $table->string('room')->nullable();
            $table->string('pic')->nullable();
            $table->integer('amount')->nullable();
            $table->string('food')->nullable()->default(\App\Util\Constant::FOOD_NO);
            $table->string('reservationDate')->nullable();
            $table->string('reservationTimeFrom')->nullable();
            $table->string('reservationTimeTo')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('reservation');
    }
}
