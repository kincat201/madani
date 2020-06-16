<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->integer('member_id')->index('member_id')->nullable();
            $table->string('code')->index('code')->nullable();
            $table->integer('is_design')->nullable();
            $table->date('payment_date')->index('payment_date')->nullable();
            $table->date('deadline')->nullable();
            $table->decimal('design_fee',15,0)->default(0)->nullable();
            $table->decimal('marketing_fee',15,0)->default(0)->nullable();
            $table->decimal('finishing_fee',15,0)->default(0)->nullable();
            $table->decimal('down_payment',15,0)->default(0)->nullable();
            $table->decimal('total_payment',15,0)->default(0)->nullable();
            $table->decimal('grand_total',15,0)->default(0)->nullable();
            $table->string('payment_method')->default('CASH')->nullable();
            $table->string('payment_status')->default('UNPAID')->nullable();
            $table->string('status')->default('NEW')->nullable();
            $table->text('remark')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
