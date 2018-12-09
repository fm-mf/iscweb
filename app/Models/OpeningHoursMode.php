<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Settings;

/**
 * @author Jiri Hajek
 */
class OpeningHoursMode extends Model {
	public $timestamps = false;
	protected $primaryKey = "id_mode";
	protected $table = "opening_hours_mode";

	public static $dow = [ "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday" ];

	public static function getCurrentMode() {
		$r = \Settings::get( "openingHoursMode" );
		return $r;
	}

	public static function setMode( $mode ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return false;
		}

		\Settings::set( "openingHoursMode", $mode );

		return true;
	}

	public static function listModes() {
		return self::pluck( "mode" )->toArray();
	}

	public function __toString() {
		return $this->getCurrentMode();
	}

	public static function getText( $mode ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return null;
		}

		$r = self::where( "mode", $mode )->pluck( "hours_json" )->first();
		$d = json_decode( $r );
		return str_replace( "<br>", "\n", $d->text );
	}

	public static function getCurrentText() {
		return self::getText( self::getCurrentMode() );
	}

	public static function getHours( $mode ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return null;
		}

		$r = self::where( "mode", $mode )->pluck( "hours_json" )->first();
		$d = json_decode( $r );

		$result = array();
		foreach ( self::$dow as $day ) {
			$result[ $day ] = $d->hours->$day;
		}

		return $result;
	}

	public static function getCurrentHours() {
		return self::getHours( self::getCurrentMode() );
	}

	public static function areHoursShown( $mode ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return null;
		}

		return self::where( "mode", $mode )->pluck( "show_hours" )->first();
	}

	public static function areCurrentHoursShown() {
		return self::areHoursShown( self::getCurrentMode() );
	}

	public static function showHours( $mode ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return false;
		}

		self::where( "mode", $mode )->update( [ "show_hours" => true ] );
	}

	public static function showCurrentHours() {
		return self::showHours( self::getCurrentMode() );
	}

	public static function hideHours( $mode ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return false;
		}

		self::where( "mode", $mode )->update( [ "show_hours" => false ] );
	}

	public static function hideCurrentHours() {
		return self::hideHours( self::getCurrentMode() );
	}

	public static function updateText( $mode, $text ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return false;
		}

		$text = htmlentities( $text );
		$text = str_replace( "\n", "<br>", $text );
		$text = str_replace( "&quot;", "\"", $text );

		self::where( "mode", $mode )->update( [ "hours_json->text" => $text ] );
		return true;
	}

	public static function updateHours( $mode, $json ) {
		if ( ! in_array( $mode, self::listModes() ) ) {
			return false;
		}

		$json = htmlentities( $json );
		$json = str_replace( "\n", "<br>", $json );
		$json = str_replace( "&quot;", "\"", $json );

		self::where( "mode", $mode )->update( [ "hours_json" => '{"text": "' . self::getCurrentText() . '", "hours": ' . $json . '}' ] );

		return true;
	}

	public static function buildHoursTable() {
		if ( ! self::areCurrentHoursShown() ) {
			return "";
		}
		$h = self::getCurrentHours();

		$r = "<table class='opening-hours'>";

		foreach ( self::$dow as $day ) {
			$v = str_replace( "-", "&ndash;", $h[ $day ] );
			$r .= "
			<tr>
				<th>" . $day . "</th>
				<td>" . $v . "</td>
			</tr>
			";
		}

		$r .= "</table>";

		return $r;
	}
}
