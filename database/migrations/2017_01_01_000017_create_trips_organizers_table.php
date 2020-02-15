<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsOrganizersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips_organizers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_trip');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('add_by');
            $table->timestamps();

            $table->foreign('id_trip')->references('id_trip')->on('trips')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('people')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('add_by')->references('id_user')->on('buddies')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips_organizers');
    }
}
