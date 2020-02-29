<?php

use App\Facades\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpeningHoursModeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::create('opening_hours_mode', function (Blueprint $table) {
            $table->tinyIncrements('id_opening_hours_mode');
            $table->boolean('show_hours');
            $table->string('mode')->unique();
            $table->json('hours_json');
        });

        Settings::push('openingHoursMode', 'Regular hours');
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
    {
        Settings::delete('openingHoursMode');

	    Schema::dropIfExists('opening_hours_mode');
	}
}
