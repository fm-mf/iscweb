<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReciptIdToTripsParticipants extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips_participants', function (Blueprint $table) {
            $table->unsignedInteger('id_receipt')
                ->after('id_user')
                ->nullable();

            $table
                ->foreign('id_receipt')
                ->references('id_receipt')
                ->on('receipts')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips_participants', function (Blueprint $table) {
            $table->dropColumn('id_receipt');
        });
    }
}
