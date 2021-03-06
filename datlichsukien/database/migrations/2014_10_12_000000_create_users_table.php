<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->integer('status')->default(1);
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->integer('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken()->nullable();
            $table->integer('role')->default(3);
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
