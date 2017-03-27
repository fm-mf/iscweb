<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResultsLS2016Table extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('resultsLS2016', function(Blueprint $table)
		{
			$table->increments('id_vote');
			$table->integer('id_user')->unsigned();
			$table->char('bestvideo', 3)->nullable();
			$table->char('bestfood', 3)->nullable();
			$table->char('bestshow', 3)->nullable();
			$table->text('fb', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('resultsLS2016');
	}

}
