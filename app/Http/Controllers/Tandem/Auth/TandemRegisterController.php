<?php

namespace App\Http\Controllers\Tandem\Auth;

use App\Models\Country;
use App\Models\Language;
use App\Models\TandemUser;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TandemRegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest:tandem');
    }

    protected function guard()
    {
        return auth()->guard('tandem');
    }

    public function showRegistrationForm()
    {
        $countries = Country::all(['id_country', 'full_name']);
        $languages = Language::all(['id_language', 'language']);

        return view('tandem.auth.register', compact('countries', 'languages'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:tandem_users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'integer', 'exists:countries,id_country'],
            'about' => ['nullable', 'string'],
            'languagesToTeach' => ['required', 'array', 'min:1', 'exists:languages,id_language'],
            'languagesToLearn' => ['required', 'array', 'min:1', 'exists:languages,id_language'],
        ]);
    }

    protected function create(array $data)
    {
        $tandemUser = TandemUser::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'passhash' => TandemUser::generateOldPasshash([
                'email' => $data['email'],
                'password' => $data['password']
            ]),
            'first_name' => $data['firstName'],
            'last_name' => $data['lastName'] ?? null,
            'id_country' => $data['country'] ?? null,
            'about' => $data['about'] ?? null,
            'registered_at' => Carbon::now(),
        ]);

        $tandemUser->languagesToTeach()->sync($data['languagesToTeach']);
        $tandemUser->languagesToLearn()->sync($data['languagesToLearn']);

        return $tandemUser;
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();

        return redirect()->route('tandem.login')->with('registrationSuccessful', true);
    }
}
