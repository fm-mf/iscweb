<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArrivalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('arrivals', function(Blueprint $table)
		{
			$table->foreign('id_user', 'fk_exchange_students')->references('id_user')->on('exchange_students')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('id_transportation', 'fk_transportations')->references('id_transportation')->on('transportation')->onUpdate('CASCADE')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('arrivals', function(Blueprint $table)
		{
			$table->dropForeign('fk_exchange_students');
			$table->dropForeign('fk_transportations');
		});
	}

}
