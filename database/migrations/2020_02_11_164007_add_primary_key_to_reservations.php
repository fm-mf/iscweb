<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrimaryKeyToReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // We have to drop foreign keys before dropping primary key due to InnoDB bug
        Schema::table('event_reservations', function (Blueprint $table) {
            $table->dropForeign('event_reservations_id_user_foreign');
            $table->dropForeign('event_reservations_id_event_foreign');
        });

        Schema::table('event_reservations', function (Blueprint $table) {
            $table->dropPrimary();
        });
        
        Schema::table('event_reservations', function (Blueprint $table) {
            $table
                ->foreign('id_event')
                ->references('id_event')
                ->on('events')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table
                ->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });

        Schema::table('event_reservations', function (Blueprint $table) {
            $table->increments('id_event_reservation')->before('id_event');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_reservations', function (Blueprint $table) {
            $table->dropColumn('id_event_reservation');
        });
        Schema::table('event_reservations', function (Blueprint $table) {
            $table->primary(['id_event', 'id_user']);
        });
    }
}
