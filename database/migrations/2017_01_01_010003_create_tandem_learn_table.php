<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTandemLearnTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tandem_learn', function (Blueprint $table) {
            $table->unsignedInteger('id_tandemuser');
            $table->unsignedSmallInteger('id_language');

            $table->primary(['id_tandemuser', 'id_language']);
            $table->foreign('id_tandemuser')->references('id_tandemuser')->on('tandem_users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_language')->references('id_language')->on('languages')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tandem_learn');
    }
}
