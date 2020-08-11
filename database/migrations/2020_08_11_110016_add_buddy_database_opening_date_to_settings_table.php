<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBuddyDatabaseOpeningDateToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push('buddyDbFrom', '25/08/2020');
        Settings::push('buddyDbFromTime', '13:00');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::delete('buddyDbFrom');
        Settings::delete('buddyDbFromTime');
    }
}
