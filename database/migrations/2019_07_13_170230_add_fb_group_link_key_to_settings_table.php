<?php

use App\Facades\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFbGroupLinkKeyToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push('fbGroupLink', 'https://www.facebook.com/groups/ISCCTUSpring2020/');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::delete('fbGroupLink');
    }
}
