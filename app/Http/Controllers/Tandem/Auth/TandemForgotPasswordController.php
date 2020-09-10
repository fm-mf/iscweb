<?php

namespace App\Http\Controllers\Tandem\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class TandemForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest:tandem');
    }

    public function showLinkRequestForm()
    {
        return view('tandem.auth.passwords.email');
    }

    public function broker()
    {
        return Password::broker('tandem_users');
    }

    protected function sendResetLinkResponse($response)
    {
        return back()->with([
            'resetLinkSentSuccessful' => true,
            'email' => request('email'),
        ]);
    }
}
