<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesInheritanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles_inheritance', function(Blueprint $table)
		{
			$table->integer('id_role')->unsigned()->index('id_role');
			$table->integer('id_inherited_role')->unsigned()->index('id_inherited_role');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('roles_inheritance');
	}

}
