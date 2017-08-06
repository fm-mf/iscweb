<?php

namespace App\Http\Controllers\Partak;

use App\Models\Semester;
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
        $settings = \Settings::all();
        $settings['wcFrom'] = Carbon::createFromFormat('d/m/Y' ,$settings['wcFrom']);
        $settings['owFrom'] = Carbon::createFromFormat('d/m/Y' ,$settings['owFrom']);
        $settings['owTo'] = Carbon::createFromFormat('d/m/Y' ,$settings['owTo']);
        return view('partak.settings.settings')->with([
            'settings' => $settings,
            'semesters' => $semesters,
        ]);
    }

    public function submitSettings(Request $request)
    {
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
        ]);
    }
}
