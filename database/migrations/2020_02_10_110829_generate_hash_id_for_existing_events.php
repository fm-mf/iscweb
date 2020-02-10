<?php

use App\Models\Event;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GenerateHashIdForExistingEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `events` MODIFY `reservations_hash` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_bin'");

        Event::all()->each(function (Event $event) {
            $event->setReservationsHash();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Event::all()->each(function (Event $event) {
            $event->reservations_hash = null;
            $event->save();
        });

        DB::statement("ALTER TABLE `events` MODIFY `reservations_hash` VARCHAR(255) CHARACTER SET 'utf8mb4' COLLATE 'utf8mb4_unicode_520_ci'");
    }
}
