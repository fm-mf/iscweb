<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyUser;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;

class RegisterController extends Controller
{
    public $authorizedDomains = [
        'cvut.cz',
    ];

    protected function profileValidator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'max:15',
            'year' => 'digits:4'
        ]);
    }

    protected function emailValidator(array $data)
    {
        return Validator::make($data, [
            'email' => 'max:255'
        ]);
    }

    public function showProfileForm(Request $request)
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request, Guard $auth)
    {
        $this->profileValidator($request->all())->validate();

        $user = Auth::user();
        $person = $user->person;

        if ($this->isEmailVerifiable($user->email)) {
            $this->sendVerificationEmail($user->email);
            $this->redirect('/user/complete');
        } else {
            $this->redirect('user/authorize');
        }
    }

    public function showVerificationForm(Request $request)
    {
        return view('auth.verify');
    }

    public function processVerificationForm(Request $request)
    {
        $this->emailValidator($request->all())->validate();

    }

    public function verifyEmail($hash)
    {
        $user = User::findByHash($hash);
    }

    public function isEmailVerifiable($email)
    {
        $emailDomain = explode('@', $email)[2];
        foreach ($this->authorizedDomains as $domain) {
            if (preg_match(".*" . $domain), $emailDomain) {
                return true;
            }
        }

        return false;
    }

    public function sendVerificationEmail(User $user)
    {
        Mail::to($user->email)->send(new VerifyUser());
    }
}