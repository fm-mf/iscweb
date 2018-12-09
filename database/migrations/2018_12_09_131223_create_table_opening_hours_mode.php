<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOpeningHoursMode extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		\DB::statement( '
			CREATE TABLE `opening_hours_mode` (
				`id_opening_hours_mode` tinyint(4) NOT NULL AUTO_INCREMENT,
				`show_hours` tinyint(1) NOT NULL,
				`mode` varchar(100) NOT NULL,
				`hours_json` varchar(800) NOT NULL,
				PRIMARY KEY (`id_opening_hours_mode`)
			)' );

		\DB::statement( "
			INSERT INTO `opening_hours_mode` VALUES ( NULL, 0, 'Exam period / Holidays', '{\"text\":\"There are no regular opening hours during the exam period or holidays\",\"hours\":{\"Monday\":\"Closed\",\"Tuesday\":\"Closed\",\"Wednesday\":\"Closed\",\"Thursday\":\"Closed\",\"Friday\":\"Closed\",\"Saturday\":\"Closed\",\"Sunday\":\"Closed\"}}')" );

		\DB::statement( "
			INSERT INTO `opening_hours_mode` VALUES ( NULL, 0, 'Orientation Week', '{\"text\":\"There are no regular opening hours during the Orientation Week\",\"hours\":{\"Monday\":\"Closed\",\"Tuesday\":\"Closed\",\"Wednesday\":\"Closed\",\"Thursday\":\"Closed\",\"Friday\":\"Closed\",\"Saturday\":\"Closed\",\"Sunday\":\"Closed\"}}')" );

		\DB::statement( "
			INSERT INTO `opening_hours_mode` VALUES ( NULL, 1, 'Regular hours', '{\"text\":\"\",\"hours\":{\"Monday\":\"14:00 - 20:00\",\"Tuesday\":\"16:00 - 20:00\",\"Wednesday\":\"14:00 - 17:00\",\"Thursday\":\"14:00 - 20:00\",\"Friday\":\"Closed\",\"Saturday\":\"Closed\",\"Sunday\":\"Closed\"}}')" );

		\DB::statement( "
			INSERT INTO `opening_hours_mode` VALUES ( NULL, 0, 'Other', '{\"text\":\"Custom text\",\"hours\":{\"Monday\":\"Closed\",\"Tuesday\":\"Closed\",\"Wednesday\":\"Closed\",\"Thursday\":\"Closed\",\"Friday\":\"Closed\",\"Saturday\":\"Closed\",\"Sunday\":\"Closed\"}}')" );

		\DB::statement( "
			INSERT INTO `settings` VALUES ( 'openingHoursMode', 'Regular hours')" );
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		\DB::statement( "
			DELETE FROM `settings` WHERE `key` = 'openingHoursMode'" );

		\DB::statement( "
			DROP TABLE `opening_hours_mode`" );
	}
}
