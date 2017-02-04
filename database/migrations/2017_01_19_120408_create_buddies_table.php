<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuddiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buddies', function(Blueprint $table)
		{
			$table->integer('id_user')->unsigned()->primary();
			$table->boolean('id_faculty')->nullable()->index('id_faculty');
			$table->text('about', 65535)->nullable();
			$table->string('phone', 20)->nullable();
			$table->enum('active', array('y','n'))->default('n');
			$table->enum('subscribed', array('y','n'))->default('y');
			$table->enum('alive', array('y','n'))->default('n');
			$table->enum('verified', array('y','n', 'd'))->default('n'); // yes/no/denied
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('buddies');
	}

}
