<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->increments('id_event');
			$table->dateTime('datetime_from')->nullable();
			$table->dateTime('visible_from')->nullable();
			$table->string('name', 200);
			$table->string('facebook_url', 200)->nullable();
			$table->text('description', 65535);
			$table->timestamps();
			$table->integer('id_trip')->unsigned()->nullable()->index('id_trip');
			$table->integer('modified_by')->unsigned()->index('modified_by');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('events');
	}

}
