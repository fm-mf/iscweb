<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormFieldsToEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedTinyInteger('id_semester')->nullable()->after('id_event');
            $table->boolean('ow')->default(false);
            $table->boolean('reservations_enabled')->default(false);
            $table->string('reservations_hash')->nullable()->unique();
            $table->integer('reservations_removal_limit')->nullable();
            $table->boolean('reservations_diet')->nullable();
            $table->boolean('reservations_medical')->nullable();

            $table
                ->foreign('id_semester')
                ->references('id_semester')
                ->on('semesters')
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['id_semester']);

            $table->dropColumn('id_semester');
            $table->dropColumn('ow');
            $table->dropColumn('reservations_enabled');
            $table->dropColumn('reservations_hash');
            $table->dropColumn('reservations_removal_limit');
            $table->dropColumn('reservations_diet');
            $table->dropColumn('reservations_medical');
        });
    }
}
