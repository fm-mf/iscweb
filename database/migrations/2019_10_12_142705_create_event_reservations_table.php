<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_reservations', function (Blueprint $table) {
            $table->integer('id_event')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->dateTime('expires_at');
            $table->text('medical_issues')->nullable();
            $table->enum('diet', ['Vegetarian', 'Vegan', 'Fish only'])->nullable();
            $table->text('notes')->nullable();
            $table->string('hash', 32);

            $table->primary(['id_event', 'id_user']);
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
            $table
                ->foreign('deleted_by')
                ->references('id_user')
                ->on('users')
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
        Schema::dropIfExists('event_reservations');
    }
}
