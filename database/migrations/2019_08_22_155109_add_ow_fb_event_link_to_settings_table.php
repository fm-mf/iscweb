<?php

use App\Facades\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOwFbEventLinkToSettingsTable extends Migration
{
    private $settingsKey = 'owFbEventLink';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Settings::push($this->settingsKey, 'https://www.facebook.com/events/454633535219010/');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Settings::delete($this->settingsKey);
    }
}
