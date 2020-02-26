<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemestersHasExchangeStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters_has_exchange_students', function (Blueprint $table) {
            $table->unsignedInteger('id_user');
            $table->unsignedTinyInteger('id_semester');

            $table->primary(['id_user', 'id_semester']);
            $table->foreign('id_user')->references('id_user')->on('exchange_students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_semester')->references('id_semester')->on('semesters')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semesters_has_exchange_students');
    }
}
