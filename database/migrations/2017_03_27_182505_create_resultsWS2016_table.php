<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsWS2016Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resultsWS2016', function(Blueprint $table)
		{
			$table->increments('id_vote');
			$table->integer('id_user')->unsigned();
			$table->char('bestperformance', 3);
			$table->char('bestfood', 3);
			$table->char('bestshow', 3);
			$table->text('fb', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resultsWS2016');
	}

}
