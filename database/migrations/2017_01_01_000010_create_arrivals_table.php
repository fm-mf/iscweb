<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrivals', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();
            $table->dateTime('arrival');
            $table->unsignedTinyInteger('id_transportation');

            $table->foreign('id_user')->references('id_user')->on('exchange_students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_transportation')->references('id_transportation')->on('transportation')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arrivals');
    }
}
