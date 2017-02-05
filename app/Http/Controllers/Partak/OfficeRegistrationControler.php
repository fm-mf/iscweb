<?php
/**
 * Created by PhpStorm.
 * User: speedy
 * Date: 5.2.17
 * Time: 9:41
 */

namespace App\Http\Controllers\Partak;

use App\Models\Buddy;
use App\Models\ExchangeStudent;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Settings\Facade as Settings;
use App\Models\Faculty;
use Illuminate\Support\Facades\Validator;

class OfficeRegistrationControler extends Controller
{
    public function showOfficeRegistrationDashboard()
    {
        return view('partak.users.officeRegistration.dashboard');
    }

    public function showExchangeStudent($id)
    {
        $exStudent = ExchangeStudent::eagerFind($id);
        return view('partak.users.officeRegistration.edit')->with([
            'exStudent' => ExchangeStudent::with('person.user')->find($id),
            'faculties' => Faculty::getOptions(),
            'accommodations' => Accommodation::getOptions(),
        ]);
    }

    public function esnRegistration($id)
    {
        return back();
    }

}