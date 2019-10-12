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
            $table->boolean('preregistration')->default('0');
            $table->char('preregistration_hash', 100)->nullable();
            $table->integer('preregistration_removal_limit')->nullable();
            $table->boolean('preregistration_diet')->nullable();
            $table->boolean('preregistration_medical')->nullable();
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
            $table->dropColumn('preregistration');
            $table->dropColumn('preregistration_hash');
            $table->dropColumn('preregistration_removal_limit');
            $table->dropColumn('preregistration_diet');
            $table->dropColumn('preregistration_medical');
        });
    }
}
