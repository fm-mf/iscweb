<?php

namespace App\Http\Controllers\Tandem\Auth;

use App\Helpers\Locale;
use App\Models\TandemUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TandemLoginController extends Controller
{
    use AuthenticatesUsers
    {
        attemptLogin as protected traitAttemptLogin;
        logout as protected traitLogout;
    }

    public function __construct()
    {
        $this->middleware('guest:tandem')->except('logout');
    }

    protected function redirectTo()
    {
        return route('tandem.main');
    }

    protected function guard()
    {
        return auth()->guard('tandem');
    }

    public function showLoginForm()
    {
        return view('tandem.auth.login');
    }

    protected function attemptLogin(Request $request)
    {
        if ($this->traitAttemptLogin($request)) {
            return true;
        }

        $credintials = $this->credentials($request);
        $credintials['passhash'] = TandemUser::generateOldPasshash($credintials);
        $user = TandemUser::where('email', $credintials['email'])->first();

        if (!isset($user) || !hash_equals($user->getAuthPassword(), $credintials['passhash'])) {
            return false;
        }

        $this->guard()->login($user);

        $user->update([
            'password' => bcrypt($credintials['password']),
        ]);

        return true;
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        $locale = session(Locale::SESSION_KEY);
        $localeTandem = session(Locale::SESSION_KEY_TANDEM);

        $this->traitLogout($request);

        $user === null ?: auth()->login($user);
        $locale === null ?: session([Locale::SESSION_KEY => $locale]);
        $localeTandem === null ?: session([Locale::SESSION_KEY => $localeTandem]);

        return redirect()->route('tandem.index')->with('logoutSuccessful', true);
    }
}
