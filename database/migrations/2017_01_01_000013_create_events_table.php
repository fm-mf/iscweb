<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id_event');
            $table->string('name');
            $table->timestamp('datetime_from')->nullable();
            $table->timestamp('visible_from')->nullable();
            $table->string('facebook_url')->nullable();
            $table->text('description');
            $table->string('cover')->nullable();
            $table->enum('event_type', ['normal', 'integreat', 'languages'])->default('normal');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('modified_by');
            $table->timestamps();

            $table->foreign('created_by')->references('id_user')->on('buddies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('modified_by')->references('id_user')->on('buddies')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
