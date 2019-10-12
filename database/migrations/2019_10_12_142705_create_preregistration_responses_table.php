<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreregistrationResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preregistration_responses', function (Blueprint $table) {
            $table->integer('id_event')->unsigned()->primary();
            $table->integer('id_user')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->text('medical_issues')->nullable();
            $table->enum('diet', ['Vegetarian','Vegan','Fish only'])->nullable();
            $table->text('notes')->nullable();

            $table->foreign('id_event')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('id_user')->references('id_user')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('deleted_by')->references('id_user')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('preregistration_responses');
    }
}
