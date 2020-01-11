<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventReservationAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reservation_answers', function (Blueprint $table) {
            $table->unsignedInteger('id_event');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_question');
            $table->text('value');

            $table->primary(['id_event', 'id_user', 'id_question'], 'pk_event_reservation_answer');
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
            $table->foreign('id_question')
                ->references('id_question')
                ->on('event_reservation_questions')
                ->onUpdate('RESTRICT')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_reservation_answers');
    }
}
