<?php

namespace App\Http\Controllers\Partak;

use App\Facades\Settings;
use App\Models\Semester;
use App\Models\OpeningHoursMode;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function showSettings()
    {
        $this->authorize('acl', 'settings.edit');
        $currentSemester = Semester::getCurrentSemester();
        $sems = Semester::orderBy('id_semester')->get();
        $semesters = [];
        foreach ($sems as $semester) {
            $semesters[$semester->semester] = $semester->semester;
        }

        $opms = OpeningHoursMode::listModes();
        $openingHoursModes = array();
        foreach ($opms as $opm) {
            $openingHoursModes[$opm] = $opm;
        }

        $settings = Settings::all();
        $settings['buddyDbFrom'] = Carbon::parse($settings['buddyDbFrom']);
        $settings['wcFrom'] = Carbon::createFromFormat('d/m/Y', $settings['wcFrom']);
        $settings['owFrom'] = Carbon::createFromFormat('d/m/Y', $settings['owFrom']);
        $settings['owTo'] = Carbon::createFromFormat('d/m/Y', $settings['owTo']);
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
        $this->authorize('acl', 'settings.edit');
        $this->settingsValidator($request->all())->validate();

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }

        $data['buddyDbFrom'] = Carbon::parse("{$data['buddyDbFromDate']} {$data['buddyDbFromTime']}");
        unset($data['buddyDbFromDate']);
        unset($data['buddyDbFromTime']);
        $data['wcFrom'] = Carbon::createFromFormat('d M Y', $data['wcFrom'])->format('d/m/Y');
        $data['owFrom'] = Carbon::createFromFormat('d M Y', $data['owFrom'])->format('d/m/Y');
        $data['owTo'] = Carbon::createFromFormat('d M Y', $data['owTo'])->format('d/m/Y');
        $data['owTripsEnabled'] = $request->input('owTripsEnabled', 0) ? 1 : 0;
        $data['owTripsRestricted'] = $request->input('owTripsRestricted', 0) ? 1 : 0;

        foreach ($data as $key => $value) {
            Settings::set($key, $value);
        }

        if (!isset($data['electionStreamUrl'])) {
            Settings::set('electionStreamUrl', '');
        }

        return back()->with(['successUpdate' => true]);
    }

    public function showOpeningHours()
    {
        $this->authorize('acl', 'settings.edit');

        return view('partak.settings.openingHours')->with([
            'settings' => Settings::all(),
            'currentMode' => OpeningHoursMode::getCurrentMode(),
            'availableModes' => OpeningHoursMode::all()->mapWithKeys(function ($item) {
                return [$item['id_opening_hours_mode'] => $item['mode']];
            }),
        ]);
    }

    public function submitOpeningHours()
    {
        $this->authorize('acl', 'settings.edit');

        $data = request()->validate([
            'id_opening_hours_mode' => ['required', 'exists:opening_hours_mode'],
            'hours_json.text' => ['nullable', 'required_with:hours_json.textCs', 'string'],
            'hours_json.textCs' => ['nullable', 'required_with:hours_json.text', 'string'],
            'show_hours' => ['nullable', 'boolean'],
            'hours_json.hours.Monday' => ['required', 'string'],
            'hours_json.hours.Tuesday' => ['required', 'string'],
            'hours_json.hours.Wednesday' => ['required', 'string'],
            'hours_json.hours.Thursday' => ['required', 'string'],
            'hours_json.hours.Friday' => ['required', 'string'],
            'hours_json.hours.Saturday' => ['required', 'string'],
            'hours_json.hours.Sunday' => ['required', 'string'],
        ]);

        if (!isset($data['show_hours'])) {
            $data['show_hours'] = false;
        }

        $mode = OpeningHoursMode::find($data['id_opening_hours_mode']);
        $mode->update($data);
        $mode->setAsCurrent();

        return back()->with(['successUpdate' => true]);
    }

    protected function settingsValidator(array $data)
    {
        return Validator::make($data, [
            'currentSemester' => 'required',
            'rector' => 'required',
            'limitPerDay' => 'required|digits:1',
            'buddyDbFromDate' => 'required|date_format:d M Y',
            'buddyDbFromTime' => 'required|date_format:H:i',
            'wcFrom' => 'required|date_format:d M Y',
            'owFrom' => 'date_format:d M Y',
            'owTo' => 'required|date_format:d M Y',
            'electionStreamUrl' => 'nullable|url',
            'fbGroupLink' => 'nullable|url',
            'whatsAppAnnoucementsLink' => 'nullable|url',
            'whatsAppGeneralLink' => 'nullable|url'
        ]);
    }

    public function getOpeningHoursData()
    {
        $this->authorize("acl", "settings.edit");

        $mode = OpeningHoursMode::findOrFail(request()->query('mode'));

        return $mode;
    }

    public function showCoronavirus()
    {
        $this->authorize('acl', 'settings.edit');

        $page = Page::findByType('coronavirus')->first();

        return view('partak.settings.coronavirus')->with([
            'settings' => [
                'coronavirusEnabled' => Settings::get('coronavirusEnabled'),
                'content' => $page ? $page->content : '',
                'title' => $page ? $page->title : 'Coronavirus (COVID-19) Situation Information'
            ]
        ]);
    }

    public function submitCoronavirus(Request $req)
    {
        $this->authorize('acl', 'settings.edit');

        $data = $req->validate([
            'coronavirusEnabled' => 'required',
            'title' => 'required',
            'content' => 'required'
        ]);

        /** @var Page */
        $page = Page::findByType('coronavirus')->first();

        if (!$page) {
            $page = new Page([
                'type' => 'coronavirus',
                'title' => $data['title'],
                'content' => $data['content']
            ]);
            $page->save();
        } else {
            $page->update([
                'title' => $data['title'],
                'content' => $data['content']
            ]);
        }

        Settings::set('coronavirusEnabled', $data['coronavirusEnabled']);

        return redirect()->route('partak.settings.coronavirus')
            ->with(['successUpdate' => true]);
    }
}
