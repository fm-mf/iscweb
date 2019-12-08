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
            $table->integer('id_event')->unsigned();
            $table->integer('order');
            $table->boolean('required')->default('0');
            $table->enum('type', ['number', 'text', 'select']);
            $table->string('label', 255);
            $table->text('description')->nullable();
            $table->text('data')->nullable();

            $table->foreign('id_event')
                ->references('id_event')
                ->on('events')
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
        Schema::dropIfExists('event_reservation_questions');
    }
}
