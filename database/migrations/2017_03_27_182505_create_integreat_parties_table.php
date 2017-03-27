<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIntegreatPartiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('integreat_parties', function(Blueprint $table)
		{
			$table->integer('id_event')->unsigned()->index('id_event');
			$table->text('countries')->nullable();
			$table->text('theme')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('integreat_parties');
	}

}
