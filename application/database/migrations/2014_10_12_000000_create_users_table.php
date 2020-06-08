<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->index('id');
            $table->string('name')->index('name')->nullable();
            $table->string('username')->index('username')->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('email')->index('email')->nullable();
            $table->string('role')->index('role')->default('USER')->nullable();
            $table->string('phone')->index('phone')->nullable();
            $table->string('photo')->default('users/default.png');
            $table->integer('deleted')->default(0)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
