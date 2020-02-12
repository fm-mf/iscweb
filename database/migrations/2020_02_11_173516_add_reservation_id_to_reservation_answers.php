<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddReservationIdToReservationAnswers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // We have to drop foreign keys before dropping primary key due to InnoDB bug
        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_event']);
            $table->dropForeign(['id_question']);
        });

        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->dropPrimary();
        });

        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->foreign('id_question')
                ->references('id_question')
                ->on('event_reservation_questions')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });

        // Add reservation id
        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->increments('id_event_reservation_answer')->first();
            $table->unsignedInteger('id_event_reservation')
                ->after('id_event_reservation_answer');
        });

        // Update references to the reservation
        DB::statement('
            UPDATE `event_reservation_answers`
            SET id_event_reservation = (
                    SELECT id_event_reservation FROM event_reservations
                    WHERE
                        id_event = event_reservation_answers.id_event AND
                        id_user = event_reservation_answers.id_user
            );
        ');

        // Set foreign key, remove useless colums and force uniqueness
        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->foreign('id_event_reservation')
                    ->references('id_event_reservation')
                    ->on('event_reservations')
                    ->onUpdate('RESTRICT')
                    ->onDelete('RESTRICT');
            
            $table->dropColumn('id_user');
            $table->dropColumn('id_event');
            
            // Index name for this combination is too long - use custom
            $table->unique(['id_event_reservation', 'id_question'], 'uq_reservation_question');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->dropColumn('id_event_reservation');
            $table->unsignedInteger('id_event')->first();
            $table->unsignedInteger('id_user')->after('id_event');

            $table->foreign('id_event')
                ->references('id_event')
                ->on('events')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
        
        Schema::table('event_reservation_answers', function (Blueprint $table) {
            $table->primary(['id_event', 'id_user', 'id_question']);
        });
    }
}
