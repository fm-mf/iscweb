<?php

use App\Facades\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwSettings extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push('owTripsEnabled', '0');
        Settings::push('owTripsRestricted', '1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::delete('owTripsEnabled');
        Settings::delete('owTripsRestricted');
    }
}
