<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripsEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trips_events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_trip')->unsigned()->index('id_trip');
			$table->integer('id_event')->unsigned()->index('id_event');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trips_events');
	}

}
