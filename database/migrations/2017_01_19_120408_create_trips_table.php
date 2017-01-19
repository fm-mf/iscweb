<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trips', function(Blueprint $table)
		{
			$table->increments('id_trip');
			$table->string('trip_name', 80);
			$table->text('trip_description', 65535)->nullable();
			$table->text('trip_organizers', 65535)->nullable();
			$table->dateTime('trip_date_from')->nullable();
			$table->dateTime('trip_date_to')->nullable();
			$table->enum('trip_active', array('y','n'))->default('n');
			$table->smallInteger('trip_capacity')->unsigned()->nullable();
			$table->smallInteger('trip_price')->unsigned()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trips');
	}

}
