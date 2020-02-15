<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_students', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();
            $table->unsignedSmallInteger('id_country');
            $table->unsignedTinyInteger('id_accommodation');
            $table->unsignedTinyInteger('id_faculty');
            $table->unsignedInteger('id_buddy')->nullable();
            $table->timestamp('buddy_timestamp')->nullable();
            $table->text('about')->nullable();
            $table->string('school')->nullable();
            $table->enum('want_buddy', ['y', 'n'])->default('y');
            $table->string('phone')->nullable();
            $table->string('esn_card_number')->nullable();
            $table->enum('esn_registered', ['y', 'n'])->default('n');
            $table->enum('wants_present', ['y', 'n'])->default('n');

            $table->foreign('id_user')->references('id_user')->on('people')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_buddy')->references('id_user')->on('buddies')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_accommodation')->references('id_accommodation')->on('accommodation')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_country')->references('id_country')->on('countries')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('id_faculty')->references('id_faculty')->on('faculties')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange_students');
    }
}
