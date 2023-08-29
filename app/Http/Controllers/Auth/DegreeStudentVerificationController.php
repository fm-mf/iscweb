<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class DegreeStudentVerificationController extends Controller
{
    public function __construct()
    {
        app()->setLocale('en');
    }

    public function showNotice()
    {
        return view('auth.verification.verify-email');
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('auth.profile.edit')->with([
            'success' => 'Your e-mail has been successfully verified. You may now continue with filling in your profile.'
        ]);
    }

    public function resendVerification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return redirect()->route('verification.notice')->with([
            'resent' => true,
        ]);
    }
}
