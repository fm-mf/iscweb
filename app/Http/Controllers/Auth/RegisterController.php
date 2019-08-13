<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Models\Buddy;
use App\Models\Country;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Auth\Guard;

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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'id_country' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'kodex' => 'accepted',
            'agreement' => 'accepted'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $data['password'] = $this->encryptPassword($data);
        $buddy = Buddy::registerBuddy($data);
        return $buddy->person->user;

    }

    private function encryptPassword($credentials)
    {
        return bcrypt(hash("sha512", $credentials['email'] . '@' . $credentials['password']));
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    public function showRegistrationForm()
    {
        return view('auth.register')->with(['countries' => Country::getOptions(), 'id_cz' => Country::getCountryIdFromTwoLetter('CZ')]);
    }
}
