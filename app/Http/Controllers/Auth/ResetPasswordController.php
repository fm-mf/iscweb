<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
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

    /**
     * Where to redirect users after resetting their password.
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
        $this->middleware('guest');
    }

    /**
     * @param $user User
     * @param $password string
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => $this->encryptPassword($user->email, $password),
            'remember_token' => Str::random(60),
        ])->save();

        $this->guard()->login($user);
    }

    private function encryptPassword($email, $password)
    {
        return bcrypt(hash("sha512", $email . '@' . $password));
    }
}
