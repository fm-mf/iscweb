<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniqueKeyToReservations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('event_reservations', function (Blueprint $table) {
            $table->unique(['id_user', 'id_event']);
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
            $table->dropUnique(['id_user', 'id_event']);
        });
    }
}
