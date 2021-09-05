<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $this->encryptPassword($user->email, $password),
            'remember_token' => Str::random(60),
        ])->save();

        event(new PasswordReset($user));
    }

    protected function redirectTo(): string
    {
        return route('login');
    }

    private function encryptPassword($email, $password)
    {
        return Hash::make(hash("sha512", $email . '@' . $password));
    }
}
