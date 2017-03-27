<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTripsEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('trips_events', function(Blueprint $table)
		{
			$table->foreign('id_trip', 'trips_events_ibfk_1')->references('id_trip')->on('trips')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_event', 'trips_events_ibfk_2')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('trips_events', function(Blueprint $table)
		{
			$table->dropForeign('trips_events_ibfk_1');
			$table->dropForeign('trips_events_ibfk_2');
		});
	}

}
