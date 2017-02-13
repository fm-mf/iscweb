<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripsOrganizersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trips_organizers', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_trip')->unsigned()->index('id_trip');
			$table->integer('id_user')->unsigned()->index('id_user');
			$table->timestamps();
			$table->integer('add_by')->unsigned()->index('add_by');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trips_organizers');
	}

}
