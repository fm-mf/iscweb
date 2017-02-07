<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRolesInheritanceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('roles_inheritance', function(Blueprint $table)
		{
			$table->foreign('id_role', 'roles_inheritance_ibfk_4')->references('id_role')->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_inherited_role', 'roles_inheritance_ibfk_5')->references('id_role')->on('roles')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('roles_inheritance', function(Blueprint $table)
		{
			$table->dropForeign('roles_inheritance_ibfk_4');
			$table->dropForeign('roles_inheritance_ibfk_5');
		});
	}

}
