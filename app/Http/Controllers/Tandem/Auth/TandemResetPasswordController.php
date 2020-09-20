<?php

namespace App\Http\Controllers\Tandem\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class TandemResetPasswordController extends Controller
{
    use ResetsPasswords;

    public function __construct()
    {
        $this->middleware('guest:tandem');
    }

    protected function redirectTo()
    {
        return route('tandem.login');
    }

    protected function guard()
    {
        return auth()->guard('tandem');
    }

    public function broker()
    {
        return Password::broker('tandem_users');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('tandem.auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    protected function resetPassword($user, $password)
    {
        $user->setNewPassword($password);

        event(new PasswordReset($user));
    }

    protected function sendResetResponse($response)
    {
        return redirect($this->redirectPath())->with([
            'passwordResetSuccessful' => true,
        ]);
    }

    protected function rules()
    {
        return [
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
