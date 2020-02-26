<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntegreatPartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integreat_parties', function (Blueprint $table) {
            $table->unsignedInteger('id_event')->primary();
            $table->string('countries')->nullable();
            $table->string('theme')->nullable();

            $table->foreign('id_event')->references('id_event')->on('events')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integreat_parties');
    }
}
