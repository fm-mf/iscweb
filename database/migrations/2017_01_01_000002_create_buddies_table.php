<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuddiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buddies', function (Blueprint $table) {
            $table->unsignedInteger('id_user')->primary();
            $table->unsignedTinyInteger('id_faculty')->nullable();
            $table->text('about')->nullable();
            $table->string('phone')->nullable();
            $table->enum('active', ['y', 'n'])->default('n');
            $table->enum('subscribed', ['y', 'n'])->default('y');
            $table->enum('alive', ['y', 'n'])->default('n');
            $table->enum('verified', ['y', 'n', 'd'])->default('n');
            $table->boolean('welcome_mail_sent')->default(false);
            $table->timestamp('last_login')->nullable();

            $table->foreign('id_user')->references('id_user')->on('people')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('buddies');
    }
}
