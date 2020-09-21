<?php

namespace App\Http\Controllers\Partak;

use App\Exceptions\UserDoesntExist;
use App\Models\Buddy;
use App\Models\Country;
use App\Models\ExchangeStudent;
use App\Models\Accommodation;
use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ExchangeStudentsController extends Controller
{
    protected function profileValidator(array $data, $id)
    {
        $fbProfileUrlRegex = '/^(https?:\/\/)?((www|m)\.)?(facebook|fb)(\.(com|me))\/(profile\.php\?id=[0-9]+(&[^&]*)*|(?!profile\.php\?)([a-zA-Z0-9][.]*){4,}[a-zA-Z0-9]+\/?(\?.*)?)$/';
        $instagramRegex = '/^([A-Za-z0-9_](?:(?:[A-Za-z0-9_]|(?:\.(?!\.))){0,28}(?:[A-Za-z0-9_]))?)$/';

        $validator = Validator::make($data, [
            'phone' => 'max:15',
            'age' => 'digits:4',
            'email' => [
                'required',
                'max:255',
                'email',
                Rule::unique('users')->ignore($id, 'id_user'), //ignore current user when updating profile
            ],
            'esn_card_number' => 'max:12',
            'medical_issues' => 'max:255',
            'whatsapp' => ['phone:AUTO', 'nullable'],
            'facebook' => ["regex:$fbProfileUrlRegex", 'nullable'],
            'instagram' => ["regex:$instagramRegex", 'nullable'],
            'quarantined_until' => ['date_format:d M Y', 'nullable'],
        ]);

        return $validator;
    }

    public function showExchangeStudentDashboard()
    {
        $this->authorize('acl', 'exchangeStudents.view');
        return view('partak.users.exchangeSudents.dashboard');
    }

    public function showDetailExchangeStudent($id)
    {
        $this->authorize('acl', 'exchangeStudents.view');

        $exStudent = ExchangeStudent::with(['person.user', 'buddy.person.user', 'country', 'accommodation', 'faculty', 'arrival'])->find($id);
        if ($exStudent == null) {
            throw new UserDoesntExist("Exchange Student does not exist !!!");
        }

        return view('partak.users.exchangeSudents.detail')->with(['exStudent' => $exStudent,]);
    }

    public function showEditFormExchangeStudent($id)
    {
        $this->authorize('acl', 'exchangeStudents.edit');

        $exStudent = ExchangeStudent::with('person.user')->find($id);
        if ($exStudent == null) {
            throw new UserDoesntExist();
        }

        return view('partak.users.exchangeSudents.edit')->with([
            'exStudent' => $exStudent,
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
            'countries' => Country::getOptions(),
            'diets' => Person::getAllDiets(),
        ]);
    }

    public function submitEditFormExStudent(Request $request, $id)
    {
        $this->authorize('acl', 'exchangeStudents.edit');
        $this->profileValidator($request->all(), $id)->validate();

        $exStudent = ExchangeStudent::with('person.user')->find($id);

        $data = [];
        foreach ($request->all() as $key => $value) {
            if ($value) {
                $data[$key] = $value;
            }
        }

        if (isset($data['quarantined_until'])) {
            $data['quarantined_until'] = Carbon::createFromFormat('d M Y', $data['quarantined_until']);
        }

        if (!isset($data['esn_registered'])) {
            $data['esn_registered'] = 'n';
        }

        if (!isset($data['fullTime'])) {
            if ($exStudent->user->hasRole('samoplatce')) {
                $exStudent->user->removeRole('samoplatce');
            }
        } else {
            if (!$exStudent->user->hasRole('samoplatce')) {
                $exStudent->user->addRole('samoplatce');
            }
        }

        $exStudent->person->user->update($data);
        $exStudent->person->updateWithIssuesAndDiet($data);
        $exStudent->update($data);

        return back()->with(['successUpdate' => true,]);
    }
}
