<?php

namespace App\Http\Controllers\Auth;

use App\Mail\LetHRKnow;
use App\Mail\VerifyUser;
use App\Models\Buddy;
use App\Models\Faculty;
use App\Models\User;
use App\Models\Person;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    private static $allowedDomains = [
        /*********** CVUT **************/
        'fjfi.cvut.cz' => 'fjfi.cvut.cz',
        'fsv.cvut.cz' =>  'fsv.cvut.cz',
        'live.com' => 'live.com'
        /*********** VSCHT **************/
        /*********** VSE ***************/
        /*********** UK ****************/
        /*********** CULS ****************/
    ];

    protected function profileValidator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'max:15',
            'age' => 'digits:4'
        ]);
    }

    protected function emailValidator(array $data)
    {
        $validator =  Validator::make($data, [
            'email' => 'required|max:255'
        ]);

        $validator->after(function ($validator) use ($data) {
            if (!in_array($data['domain'], $this->allowedDomains)) {
                $validator->errors()->add('domain', 'Nepovolená doména');
            }
        });

        return $validator;
    }

    public function showProfileForm(Request $request)
    {
        $faculties = array();
        foreach (Faculty::all() as $faculty) {
            $faculties[$faculty->id_faculty] = $faculty->faculty;
        }

        $user = \Auth::user();
        $buddy = Buddy::with('person')->find($user->id_user);

        if ($buddy->person->avatar) {
            $avatar = 'avatars/' . $buddy->person->avatar;
        } else {
            $avatar = 'auth/img/avatar.jpg';
        }

        return view('auth.profile')->with(['faculties' => $faculties, 'avatar' => $avatar, 'buddy' => $buddy]);
    }

    public function updateProfile(Request $request)
    {
        $this->profileValidator($request->all())->validate();

        $user = \Auth::user();
        $buddy = Buddy::with('person')->find($user->id_user);

        $buddy->person->update(['sex' => $request->sex, 'age' => $request->age]);
        $buddy->update(['about' => $request->about, 'phone' => $request->phone, 'id_faculty' => $request->faculty]);

        if ($user->isBuddy()) {
            return Redirect::to('/user/profile')->with('success', true);
        } else if ($this->isEmailVerifiable($user->email)) {
            $this->sendVerificationEmail($user->email);
            return Redirect::to('user/complete')->with(['email' => $user->email]);
        } else {
            return Redirect::to('user/verify');
        }
    }

    public function showVerificationForm(Request $request)
    {
        return view('auth.verify')->with(['allowedDomains' => $this->allowedDomains]);
    }

    public function processVerificationForm(Request $request)
    {
        $this->emailValidator($request->all())->validate();

        $email = $request->email . '@' . $request->domain;
        $this->sendVerificationEmail($email);

        return redirect('/user/verification-info')->with(['email' => $email]);
    }

    public function showVerificationInfo(Request $request)
    {
        return "Verification email sent to your address " . $request->session()->get('email');
    }

    public function showVerifyEmail($hash)
    {
        $user = User::findByHash($hash);
        if ($user) {
            $buddy = Buddy::find($user->id_user);
            $buddy->setVerified();
            $hrEmail = 'michal.kral@live.com';
            Mail::to($hrEmail)->send(new LetHRKnow($buddy->person));
            return redirect('/user/verification-successful');
        } else {
            return "Wrong user!";
        }
    }

    public function showComplete()
    {
        return "Registration complete";
    }


    public function showVerificationSuccess()
    {
        return "Registration successful";
    }

    private function isEmailVerifiable($email)
    {
        $emailDomain = explode('@', $email)[1];

        if (in_array($emailDomain, $this->allowedDomains)) {
            return true;
        }
        /*
        foreach ($this->allowedDomains as $domain) {
            if (preg_match(".*" . $domain, $emailDomain)) {
                return true;
            }
        }
        */

        return false;
    }

    private function sendVerificationEmail($email)
    {
        $person = \Auth::user()->person;
        Mail::to($email)->send(new VerifyUser($person));
    }
}