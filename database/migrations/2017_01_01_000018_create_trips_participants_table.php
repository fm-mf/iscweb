<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips_participants', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_trip');
            $table->unsignedInteger('id_user');
            $table->smallInteger('paid')->nullable()->default('0');
            $table->text('comment')->nullable();
            $table->enum('stand_in', ['y', 'n'])->default('n');
            $table->unsignedInteger('registered_by');
            $table->unsignedInteger('deleted_by');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_trip')->references('id_trip')->on('trips')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('people')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('registered_by')->references('id_user')->on('buddies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('deleted_by')->references('id_user')->on('buddies')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips_participants');
    }
}
