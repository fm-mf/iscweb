<?php

use App\Facades\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameKeysToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push('officialName', 'International Student Club CTU in Prague, z. s.');
        Settings::push('fullName', 'International Student Club CTU in Prague');
        Settings::push('shortName', 'ISC CTU in Prague');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::delete('officialName');
        Settings::delete('fullName');
        Settings::delete('shortName');
    }
}
