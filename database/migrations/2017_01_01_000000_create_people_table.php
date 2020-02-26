<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->year('age')->nullable();
            $table->enum('sex', ['M', 'F'])->nullable();
            $table->enum('diet', ['Vegetarian', 'Vegan', 'Fish only'])->nullable();
            $table->string('medical_issues')->nullable();
            $table->string('avatar')->nullable();

            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
