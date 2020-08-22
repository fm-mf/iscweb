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
        Settings::push('buddyDbFrom', '2020-08-25 09:00:00');
        Settings::delete('isDatabaseOpen');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::push('isDatabaseOpen', 'false');
        Settings::delete('buddyDbFrom');
    }
}
