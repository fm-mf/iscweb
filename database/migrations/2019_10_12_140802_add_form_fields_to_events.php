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
            $table->boolean('ow')->default('0');
            $table->boolean('reservations_enabled')->default('0');
            $table->char('reservations_hash', 100)->nullable();
            $table->integer('reservations_removal_limit')->nullable();
            $table->boolean('reservations_diet')->nullable();
            $table->boolean('reservations_medical')->nullable();
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
            $table->dropColumn('ow');
            $table->dropColumn('reservations_enabled');
            $table->dropColumn('reservations_hash');
            $table->dropColumn('reservations_removal_limit');
            $table->dropColumn('reservations_diet');
            $table->dropColumn('reservations_medical');
        });
    }
}
