<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id_trip');
            $table->unsignedInteger('id_event')->unique();
            $table->timestamp('trip_date_to')->nullable();
            $table->timestamp('registration_from')->nullable();
            $table->unsignedSmallInteger('capacity')->nullable();
            $table->smallInteger('price')->nullable();
            $table->enum('type', ['exchange', 'buddy', 'ex+buddy'])->default('exchange');

            $table->foreign('id_event')->references('id_event')->on('events')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips');
    }
}
