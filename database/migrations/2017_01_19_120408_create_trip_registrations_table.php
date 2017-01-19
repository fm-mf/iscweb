<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTripRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('trip_registrations', function(Blueprint $table)
		{
			$table->increments('id_registration');
			$table->integer('id_trip')->unsigned();
			$table->integer('id_user')->unsigned();
			$table->integer('registered_by')->unsigned();
			$table->smallInteger('paid')->unsigned();
			$table->dateTime('registration_date');
			$table->string('comment')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('trip_registrations');
	}

}
