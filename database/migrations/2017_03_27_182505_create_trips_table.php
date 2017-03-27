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
			$table->integer('id_event')->unsigned()->index('id_event');
			$table->dateTime('trip_date_to')->nullable();
			$table->dateTime('registration_from')->nullable();
			$table->smallInteger('capacity')->unsigned()->default(0);
			$table->smallInteger('price')->unsigned()->default(0);
			$table->timestamps();
			$table->integer('modified_by')->unsigned()->index('modified_by');
			$table->enum('type', array('exchange','buddy','ex+buddy'))->default('exchange');
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
