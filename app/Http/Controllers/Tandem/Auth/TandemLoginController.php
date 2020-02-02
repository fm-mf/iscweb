<?php

namespace App\Http\Controllers\Tandem\Auth;

use App\Models\TandemUser;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
        return Auth::guard('tandem');
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
        $credintials['passhash'] = $this->hashPassword($credintials);
        $user = TandemUser::where('email', $credintials['email'])->first();

        if (!isset($user) || !hash_equals($user->getAuthPassword(), $credintials['passhash'])) {
            return false;
        }

        Auth::guard('tandem')->login($user);

        return true;
    }

    public function logout(Request $request)
    {
        $this->traitLogout($request);

        return redirect(route('tandem.index'))->with('logoutSuccessful');
    }

    private function hashPassword(array $credintials)
    {
        return hash('sha512', "{$credintials['email']}@{$credintials['password']}");
    }
}
