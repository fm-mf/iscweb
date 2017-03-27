<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLanguagesEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('languages_events', function(Blueprint $table)
		{
			$table->foreign('id_event', 'languages_events_ibfk_1')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('languages_events', function(Blueprint $table)
		{
			$table->dropForeign('languages_events_ibfk_1');
		});
	}

}
