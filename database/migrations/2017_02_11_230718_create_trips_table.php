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
			$table->dateTime('trip_date_to')->nullable();
			$table->dateTime('registration_from')->nullable();
			$table->dateTime('registration_to')->nullable();
			$table->smallInteger('capacity')->default(0);
			$table->smallInteger('price')->default(0);
			$table->timestamps();
			$table->integer('modified_by')->unsigned()->index('modify_by');
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
