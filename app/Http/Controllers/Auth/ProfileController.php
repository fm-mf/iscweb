<?php

namespace App\Http\Controllers\Auth;

use App\Events\BuddyRegistered;
use App\Events\BuddyVerified;
use App\Events\BuddyWithoutEmailRegistered;
use App\Mail\LetHRKnow;
use App\Mail\VerifyUser;
use App\Models\Buddy;
use App\Models\Faculty;
use App\Models\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'verifyBuddy']);
    }

    public $allowedDomains = [
        /*********** CVUT **************/
        'cvut.cz' => 'cvut.cz',
        'fsv.cvut.cz' => 'fsv.cvut.cz',
        'fs.cvut.cz' => 'fs.cvut.cz',
        'fel.cvut.cz' => 'fel.cvut.cz',
        'fjfi.cvut.cz' => 'fjfi.cvut.cz',
        'fa.cvut.cz' => 'fa.cvut.cz',
        'fd.cvut.cz' => 'fd.cvut.cz',
        'fbmi.cvut.cz' => 'fbmi.cvut.cz',
        'fit.cvut.cz' => 'fit.cvut.cz',
        'muvs.cvut.cz' => 'muvs.cvut.cz',

        /*********** VSCHT **************/
        'vscht.cz' => 'vscht.cz',

        /*********** VSE ***************/
        'vse.cz' => 'vse.cz',

        /*********** UK ****************/
        'fhs.cuni.cz' => 'fhs.cuni.cz',
        'ktf.cuni.cz' => 'ktf.cuni.c',
        'ftvs.cuni.cz' => 'ftvs.cuni.cz',
        'fsv.cuni.cz' => 'fsv.cuni.cz',
        'pedf.cuni.cz' => 'pedf.cuni.cz',
        'mff.cuni.cz' => 'mff.cuni.cz',
        'natur.cuni.cz' => 'natur.cuni.cz',
        'ff.cuni.cz' => 'ff.cuni.cz',
        'lf3.cuni.cz' => 'lf3.cuni.cz',
        'lfmotol.cuni.cz' => 'lfmotol.cuni.cz',
        'lf1.cuni.cz' => 'lf1.cuni.cz',
        'prf.cuni.cz' => 'prf.cuni.cz',
        'htf.cuni.cz' => 'htf.cuni.cz',
        'etf.cuni.cz' => 'etf.cuni.cz',
        /*********** CULS ****************/
        'af.czu.cz' => 'af.czu.cz',
        'pef.czu.cz' => 'pef.czu.cz',
        'tf.czu.cz' => 'tf.czu.cz',
        'fzp.czu.cz' => 'fzp.czu.cz',
        'fld.czu.cz' => 'fld.czu.cz',
        'ftz.czu.cz' => 'ftz.czu.cz',
        'ivp.czu.cz' => 'ivp.czu.cz'
    ];

    protected function profileValidator(array $data)
    {
        return Validator::make($data, [
            'phone' => 'max:20',
            'age' => 'integer|min:1901|max:2155|nullable'
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
            if (strpos($data['email'], '@') !== false) {
                $validator->errors()->add('email', 'Zadej prosím správný formát');
            }
        });

        return $validator;
    }

    protected function motivationValidator(array $data)
    {
        $validator = Validator::make($data, [
                'motivation' => 'required',
        ]);
        return $validator;
    }

    public function showProfileForm(Request $request)
    {

        $buddy = Buddy::with('person')->find(Auth::id());

        return view('auth.profile')->with(['faculties' => Faculty::getOptions(), 'avatar' => $buddy->person->avatar(), 'buddy' => $buddy]);
    }

    public function updateProfile(Request $request)
    {
        $this->profileValidator($request->all())->validate();

        $user = Auth::user();
        $buddy = Buddy::with('person')->find(Auth::id());

        $data = ['subscribed' => false];
        foreach ($request->all() as $key => $value) {
            $data[$key] = $value;
        }

        $buddy->person->update($data);
        $buddy->update($data);

        if ($user->isBuddy()) {
            return Redirect::to('/user/profile')->with('success', true);
        } else if ($this->isEmailVerifiable($user->email)) {

            $this->sendVerificationEmail($user->email);
            return Redirect::to('user/verification-info')->with(['email' => $user->email]);
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

    public function processNoEmail(Request $request)
    {
        $buddy = Buddy::findBuddy(Auth::id());
        $this->motivationValidator($request->all())->validate();
        event(new BuddyWithoutEmailRegistered($buddy, $request->motivation));
        return redirect('/user/thankyou')->with('verified', false);
    }

    public function showVerificationInfo(Request $request)
    {
        return view('auth.vefificationsent')->with(['email' => $request->session()->get('email')]);
    }

    public function verifyBuddy($hash)
    {
        $user = User::findByHash($hash);
        if ($user) {
            $buddy = Buddy::findBuddy($user->id_user);
            $buddy->setVerified();
            event(new BuddyVerified($buddy));
            return redirect('/user/thankyou')->with('verified', true);
        } else {
            return view('auth.invalidhash');
        }
    }

    public function showThanks(Request $request)
    {
        return view('auth.thanks')->with('verified', $request->session()->get('verified'));
    }

    private function isEmailVerifiable($email)
    {
        $emailDomain = explode('@', $email)[1];

        if (in_array($emailDomain, $this->allowedDomains)) {
            return true;
        }

        return false;
    }

    private function sendVerificationEmail($email)
    {
        $person = Auth::user()->person;
        Mail::to($email)->send(new VerifyUser($person));
    }
}
