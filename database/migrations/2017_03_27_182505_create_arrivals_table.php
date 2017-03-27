<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArrivalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('arrivals', function(Blueprint $table)
		{
			$table->integer('id_user')->unsigned()->primary();
			$table->dateTime('arrival');
			$table->boolean('id_transportation')->index('fk_transportations');
			$table->boolean('buddy_status')->nullable();
			$table->text('buddy_information', 65535)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('arrivals');
	}

}
