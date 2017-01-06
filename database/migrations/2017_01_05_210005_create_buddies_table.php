<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuddiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buddies', function (Blueprint $table) {
            $table->integer('id_buddy')->unsigned();
            $table->foreign('id_buddy')->references('id_buddy')->on('people');
            $table->tinyInteger('id_faculty');
            $table->foreign('id_faculty')->references('id_faculty')->on('faculties');
            $table->text('about');
            $table->string('phone', 20);
            $table->enum('active', ['y', 'n']);
            $table->enum('subscribed', ['y', 'n']);
            $table->enum('alive', ['y', 'n']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buddies');
    }
}
