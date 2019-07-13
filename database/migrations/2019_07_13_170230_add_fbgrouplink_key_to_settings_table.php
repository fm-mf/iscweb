<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFbgrouplinkKeyToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement( "
			INSERT INTO `settings` VALUES ( 'fbGroupLink', 'https://www.facebook.com/isc.ctu.prague/')" );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement( "
			DELETE FROM `settings` WHERE `key` = 'fbGroupLink'" );
    }
}
