<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransportationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transportation', function(Blueprint $table)
		{
			$table->boolean('id_transportation')->unique('id_transportation_UNIQUE');
			$table->string('transportation', 45);
			$table->string('eng', 45);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transportation');
	}

}
