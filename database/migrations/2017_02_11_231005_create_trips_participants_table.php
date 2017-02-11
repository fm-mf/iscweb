<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripsParticipantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trips_participants', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('id_trip')->unsigned()->index('id_trip');
			$table->integer('id_user')->unsigned()->index('id_user');
			$table->integer('paid')->unsigned()->nullable()->default(0);
			$table->text('comment', 65535)->nullable();
			$table->integer('registered_by')->unsigned()->index('registered_by');
			$table->timestamps();
			$table->enum('stand_in', array('y','n'))->nullable()->default('n');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trips_participants');
	}

}
