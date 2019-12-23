<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreContactsToExchangeStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exchange_students', function (Blueprint $table) {
            $table->string('whatsapp', 255)->after('phone')->nullable();
            $table->string('facebook', 255)->after('phone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exchange_students', function (Blueprint $table) {
            $table->dropColumn('whatsapp');
            $table->dropColumn('facebook');
        });
    }
}
