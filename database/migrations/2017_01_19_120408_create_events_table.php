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
			$table->dateTime('datetime_from');
			$table->dateTime('datetime_to');
			$table->dateTime('registration_to')->nullable();
			$table->dateTime('visible_from');
			$table->string('name', 200);
			$table->string('facebook_url', 200)->nullable();
			$table->text('description', 65535);
			$table->integer('price')->unsigned()->nullable();
			$table->integer('capacity')->unsigned()->nullable();
			$table->timestamp('modified_timestamp')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('modified_id_user')->unsigned();
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
