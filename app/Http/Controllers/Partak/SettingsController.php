<?php

namespace App\Http\Controllers\Partak;

use App\Models\Semester;
use App\Models\OpeningHoursMode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function showSettings()
    {
        $this->authorize('acl', 'settings.edit');
        $currentSemester = Semester::getCurrentSemester();
        $sems = Semester::orderBy('id_semester')->get();
        $semesters = [];
        foreach ($sems as $semester)
        {
            $semesters[$semester->semester] = $semester->semester;
        }

        $opms = OpeningHoursMode::listModes();
        $openingHoursModes = array();
        foreach ( $opms as $opm ) {
        	$openingHoursModes[ $opm ] = $opm;
        }

        $settings = \Settings::all();
        $settings['wcFrom'] = Carbon::createFromFormat('d/m/Y' ,$settings['wcFrom']);
        $settings['owFrom'] = Carbon::createFromFormat('d/m/Y' ,$settings['owFrom']);
        $settings['owTo'] = Carbon::createFromFormat('d/m/Y' ,$settings['owTo']);
        //dd( OpeningHoursMode::getCurrentDailyHours() );
        return view('partak.settings.settings')->with([
            'settings' => $settings,
            'semesters' => $semesters,
            'openingHoursModes' => $openingHoursModes,
            'openingHoursText' => OpeningHoursMode::getCurrentText(),
            'showOpeningHours' => OpeningHoursMode::areCurrentHoursShown(),
            'openingHoursData' => OpeningHoursMode::getCurrentHours(),
        ]);
    }

    public function submitSettings(Request $request)
    {
    	if ( array_key_exists( "openingHoursMode" , $request->all() ) ) {
        	return $this->submitOpeningHours( $request );
        }

        $this->authorize('acl', 'settings.edit');
        $this->SettingsValidator($request->all())->validate();
        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }
        $data['wcFrom'] = Carbon::createFromFormat('d M Y' ,$data['wcFrom'])->format('d/m/Y');
        $data['owFrom'] = Carbon::createFromFormat('d M Y' ,$data['owFrom'])->format('d/m/Y');
        $data['owTo'] = Carbon::createFromFormat('d M Y' ,$data['owTo'])->format('d/m/Y');
        //dd($data);
        foreach($data as $key => $value)
        {
            \Settings::set($key, $value);
        }
        if (!isset($data['electionStreamUrl'])) {
            \Settings::set('electionStreamUrl', '');
        }

        /*
         * TODO:
         * - 
         */

        return back()->with(['successUpdate' => true]);
    }

    public function submitOpeningHours( Request $request ) {
		$this->authorize( "acl", "settings.edit" );
		$this->OpeningHoursValidator( $request->all() )->validate();

		$data = array();
		foreach ($request->all() as $key => $value) {
			if ( $value ) {
				$data[ $key ] = $value;
			}
		}

		//dd( $data );

		OpeningHoursMode::setMode( $data[ "openingHoursMode" ] );
		\Settings::set( "openingHoursMode", OpeningHoursMode::getCurrentMode() );

		if ( ! isset( $data[ "openingHoursText" ] ) ) {
			$data[ "openingHoursText" ] = "";
		}

		OpeningHoursMode::updateText( OpeningHoursMode::getCurrentMode(), $data[ "openingHoursText" ] );

		if ( ! isset( $data[ "showOpeningHours" ] ) ) {
			OpeningHoursMode::hideCurrentHours();
		} else {
			OpeningHoursMode::showCurrentHours();
			$hours_json = '{';
			for ( $i = 0; $i < count( OpeningHoursMode::$dow ) - 1; ++$i ) {
				$hours_json .= '"' . OpeningHoursMode::$dow[ $i ] . '": "' . ( isset( $data[ "openingHoursData-" . OpeningHoursMode::$dow[ $i ] ] ) ? $data[ "openingHoursData-" . OpeningHoursMode::$dow[ $i ] ] : "" ) . '",';
			}
			$hours_json .= '"' . OpeningHoursMode::$dow[ $i ] . '": "' . ( isset( $data[ "openingHoursData-" . OpeningHoursMode::$dow[ $i ] ] ) ? $data[ "openingHoursData-" . OpeningHoursMode::$dow[ $i ] ] : "" ) . '"}';
			OpeningHoursMode::updateHours( OpeningHoursMode::getCurrentMode(), $hours_json );
		}

		return back()->with(['successUpdate' => true]);
	}

    protected function SettingsValidator(array $data)
    {
        return Validator::make($data, [
            'currentSemester' => 'required',
            'rector' => 'required',
            'limitPerDay' => 'required|digits:1',
            'isDatabaseOpen' => 'required',
            'wcFrom' => 'required|date_format:d M Y',
            'owFrom' => 'date_format:d M Y',
            'owTo' => 'required|date_format:d M Y',
            'electionStreamUrl' => 'nullable|url',
            'fbGroupLink' => 'nullable|url'
        ]);
    }

	protected function OpeningHoursValidator( array $data ) {
		return Validator::make( $data,
		                        [ "openingHoursMode" => "required", ] );
	}

	public static function getOpeningHours() {
    	$mode = isset( $_GET[ "mode" ] ) ? $_GET[ "mode" ] : null;
    	if ( ! in_array( $mode, OpeningHoursMode::listModes() ) ) {
    		return "";
    	}

    	return json_encode( array( "text" => OpeningHoursMode::getText( $mode ), "show_hours" => OpeningHoursMode::areHoursShown( $mode ) ,"hours" => OpeningHoursMode::getHours( $mode ) ) ) ? json_encode( array( "text" => OpeningHoursMode::getText( $mode ), "show_hours" => OpeningHoursMode::areHoursShown( $mode ), "hours" => OpeningHoursMode::getHours( $mode ) ) ) : "";
    }
}
