<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTandemUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tandem_users', function (Blueprint $table) {
            $table->increments('id_tandemuser');
            $table->string('email')->unique();
            $table->string('passhash')->nullable();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->unsignedSmallInteger('id_country')->nullable();
            $table->text('about')->nullable();
            $table->boolean('visible')->default(true);
            $table->dateTime('registered_at')->nullable();
            $table->dateTime('last_login')->nullable();

            $table->foreign('id_country')->references('id_country')->on('countries')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tandem_users');
    }
}
