<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventsParticipantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events_participants', function(Blueprint $table)
		{
			$table->foreign('id_event', 'events_participants_ibfk_1')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_user', 'events_participants_ibfk_2')->references('id_user')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events_participants', function(Blueprint $table)
		{
			$table->dropForeign('events_participants_ibfk_1');
			$table->dropForeign('events_participants_ibfk_2');
		});
	}

}
