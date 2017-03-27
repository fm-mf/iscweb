<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIntegreatPartiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('integreat_parties', function(Blueprint $table)
		{
			$table->foreign('id_event', 'integreat_parties_ibfk_1')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('id_event', 'integreat_parties_ibfk_2')->references('id_event')->on('events')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('integreat_parties', function(Blueprint $table)
		{
			$table->dropForeign('integreat_parties_ibfk_1');
			$table->dropForeign('integreat_parties_ibfk_2');
		});
	}

}
