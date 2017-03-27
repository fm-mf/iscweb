<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsOrganizersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events_organizers', function(Blueprint $table)
		{
			$table->increments('id_organizer');
			$table->integer('id_user')->unsigned()->index('id_user');
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
		Schema::drop('events_organizers');
	}

}
