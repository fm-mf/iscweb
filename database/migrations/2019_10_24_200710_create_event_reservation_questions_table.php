<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventReservationQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reservation_questions', function (Blueprint $table) {
            $table->increments('id_question');
            $table->unsignedInteger('id_event');
            $table->integer('order');
            $table->boolean('required')->default(false);
            $table->enum('type', ['number', 'text', 'select']);
            $table->string('label');
            $table->text('description')->nullable();
            $table->json('data')->nullable();

            $table->foreign('id_event')
                ->references('id_event')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['id_event', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_reservation_questions');
    }
}
