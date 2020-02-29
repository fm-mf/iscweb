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
            $table->unsignedInteger('id_event');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('deleted_by')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->text('medical_issues')->nullable();
            $table->enum('diet', ['Vegetarian', 'Vegan', 'Fish only'])->nullable();
            $table->text('notes')->nullable();
            $table->string('hash')->unique();

            $table->primary(['id_event', 'id_user']);
            $table
                ->foreign('id_event')
                ->references('id_event')
                ->on('events')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table
                ->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table
                ->foreign('deleted_by')
                ->references('id_user')
                ->on('users')
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
        Schema::dropIfExists('event_reservations');
    }
}
