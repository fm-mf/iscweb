<?php

namespace App\Http\Controllers\Auth;

use App\Models\Buddy;
use App\Models\Country;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    const REGISTRATION_TYPES = [
        'local' => 'auth.register',
        'exchange' => 'auth.register-exchange',
        'degree' => 'auth.register-degree',
    ];

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'code_of_conduct' => ['accepted'],
            'agreement' => ['accepted'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $data['password'] = $this->encryptPassword($data);

        $buddy = Buddy::registerBuddy($data);

        return $buddy->user;
    }

    private function encryptPassword($credentials)
    {
        return Hash::make(hash("sha512", $credentials['email'] . '@' . $credentials['password']));
    }

    public function showRegistrationForm()
    {
        if (!session()->has('registrationType') && !session()->hasOldInput()) {
            return view('auth.preregister-check')->with([
                'registrationTypes' => array_keys(self::REGISTRATION_TYPES),
            ]);
        }

        return view(self::REGISTRATION_TYPES[session('registrationType', 'local')]);
    }

    public function registerCheck()
    {
        request()->validate([
            'registration_type' => ['required', 'string', Rule::in(array_keys(self::REGISTRATION_TYPES))],
        ]);

        return redirect()->route('register')->with([
            'registrationType' => request()->get('registration_type')
        ]);
    }
}
