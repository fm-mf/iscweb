<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Locale;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use  Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as traitLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['password'] = $this->encryptPassword($credentials);
        return $credentials;
    }

    private function encryptPassword($credentials)
    {
        return hash("sha512", $credentials['email'] . '@' . $credentials['password']);
    }

    public function logout(Request $request)
    {
        $tandemUser = auth('tandem')->user();
        $locale = session(Locale::SESSION_KEY);
        $localeTandem = session(Locale::SESSION_KEY_TANDEM);

        $return = $this->traitLogout($request);

        $tandemUser === null ?: auth('tandem')->login($tandemUser);
        $locale === null ?: session([Locale::SESSION_KEY => $locale]);
        $localeTandem === null ?: session([Locale::SESSION_KEY_TANDEM => $localeTandem]);

        return $return;
    }
}
