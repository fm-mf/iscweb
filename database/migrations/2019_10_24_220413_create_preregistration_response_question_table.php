<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreregistrationResponseQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preregistration_response_questions', function (Blueprint $table) {
            $table->integer('id_event')->unsigned();
            $table->integer('id_user')->unsigned();
            $table->integer('id_question')->unsigned();
            $table->text('value');

            $table->primary(['id_event', 'id_user', 'id_question'], 'pk_preregistration_response_question');
            $table->foreign('id_event')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_question')->references('id_question')->on('preregistration_questions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preregistration_response_questions');
    }
}
