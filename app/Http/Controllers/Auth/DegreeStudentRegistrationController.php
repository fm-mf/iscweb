<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\DegreeStudent;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DegreeStudentRegistrationController extends Controller
{
    use RegistersUsers;

    public function showRegistrationForm()
    {
        return view('auth.register-degree-student')->with([
            'countries' => Country::getOptions(),
            'faculties' => Faculty::getOptions(),
        ]);
    }

    protected function create(array $data)
    {
        $data = $this->validator($data)->validated();

        $data['password'] = $this->encryptPassword(Arr::only($data, ['email', 'password']));

        $degreeStudent = DegreeStudent::registerDegreeStudent($data);

        return $degreeStudent->user;
    }

    protected function registered(Request $request, $user)
    {
        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_country' => ['required', 'integer', 'exists:countries'],
            'id_faculty' => ['required', 'integer', 'exists:faculties'],
            'agreement' => ['accepted'],
        ]);
    }

    private function encryptPassword($credentials)
    {
        return Hash::make(hash("sha512", $credentials['email'] . '@' . $credentials['password']));
    }
}
