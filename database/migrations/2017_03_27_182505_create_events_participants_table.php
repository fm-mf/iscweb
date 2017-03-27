<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsParticipantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events_participants', function(Blueprint $table)
		{
			$table->increments('id_participant');
			$table->integer('id_event')->unsigned()->index('id_event');
			$table->integer('id_user')->unsigned()->index('id_user');
			$table->timestamp('timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->enum('stand_in', array('y','n'))->default('n');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events_participants');
	}

}
