<?php

namespace App\Http\Controllers\Auth;

use App\Events\BuddyRegistered;
use App\Events\BuddyVerified;
use App\Events\BuddyWithoutEmailRegistered;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Faculty;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['verifyBuddy', 'showThanks']]);
    }

    public $allowedDomains = [
        /*********** CVUT **************/
        'fa.cvut.cz' => 'fa.cvut.cz',
        'fbmi.cvut.cz' => 'fbmi.cvut.cz',
        'fd.cvut.cz' => 'fd.cvut.cz',
        'fel.cvut.cz' => 'fel.cvut.cz',
        'fit.cvut.cz' => 'fit.cvut.cz',
        'fjfi.cvut.cz' => 'fjfi.cvut.cz',
        'fs.cvut.cz' => 'fs.cvut.cz',
        'fsv.cvut.cz' => 'fsv.cvut.cz',
        'muvs.cvut.cz' => 'muvs.cvut.cz',
        'cvut.cz' => 'cvut.cz',

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

    public function showProfileForm()
    {
        return view('auth.profile')->with([
            'buddy' => auth()->user()->buddy->load(['person', 'user']),
            'sexOptions' => Person::getSexOptions(),
            'countries' => Country::getOptions(),
            'faculties' => Faculty::getOptions(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $validated = $this->profileValidator($request->all())->validate();
        $validated['subscribed'] ??= false;

        $user = auth()->user();
        $buddy = $user->buddy;

        $buddy->person->update(Arr::only($validated, ['age', 'sex']));
        $buddy->update(Arr::except($validated, ['age', 'sex']));

        if ($buddy->isVerified()) {
            return redirect()->route('auth.profile.edit')->with([
                'success' => __('auth.profile.updated-successfully')
            ]);
        }

        return $this->skipToVerification();
    }

    public function skipToVerification()
    {
        if ($this->attemptEmailVerification(auth()->user())) {
            $with = [
                'verification_mail_sent' => __('auth.verification.mail-sent', ['email' => auth()->user()->email]),
            ];
        }

        return redirect()->route('auth.verification.request')->with($with ?? []);
    }

    public function showVerificationForm()
    {
        return view('auth.verification.verify')->with([
            'allowedDomains' => $this->allowedDomains,
        ]);
    }

    public function processVerificationForm(Request $request)
    {
        $this->emailValidator($request->all())->validate();

        $buddy = auth()->user()->buddy;

        $buddy->update([
            'verification_email' => "{$request->input('email')}@{$request->input('domain')}",
        ]);

        event(new BuddyRegistered($buddy));

        return redirect()->route('auth.verification.request')->with([
            'verification_mail_sent' => __('auth.verification.mail-sent', ['email' => $buddy->user->email]),
        ]);
    }

    public function processNoEmail(Request $request)
    {
        $this->motivationValidator($request->all())->validate();

        $buddy = auth()->user()->buddy;

        $buddy->update([
            'motivation' => $request->motivation,
        ]);

        event(new BuddyWithoutEmailRegistered($buddy));

        return redirect()->route('auth.verification.verified')->with([
            'verified' => false
        ]);
    }

    public function verifyBuddy(string $hash)
    {
        $user = User::findByHash($hash);
        if (empty($user)) {
            return view('auth.verification.invalid-hash');
        }

        $user->buddy->setVerified();

        event(new BuddyVerified($user->buddy));

        return redirect()->route('auth.verification.verified')->with([
            'verified' => true,
        ]);
    }

    public function showThanks(Request $request)
    {
        return view('auth.verification.thanks')->with([
            'verified' => $request->session()->get('verified'),
        ]);
    }

    protected function isEmailVerifiable(string $email): bool
    {
        $emailDomain = explode('@', $email)[1];

        return in_array($emailDomain, $this->allowedDomains);
    }

    protected function attemptEmailVerification(User $user): bool
    {
        if (!$this->isEmailVerifiable($user->email)) {
            return false;
        }

        $user->buddy->update([
            'verification_email' => $user->email,
        ]);

        event(new BuddyRegistered($user->buddy));

        return true;
    }

    protected function profileValidator(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'sex' => ['nullable', 'string', 'in:M,F'],
            'age' => ['nullable', 'integer', 'min:1901', 'max:2155'],
            'id_country' => ['nullable', 'integer', 'exists:countries'],
            'id_faculty' => ['nullable', 'integer', 'exists:faculties'],
            'phone' => ['nullable', 'phone:AUTO,CZ,SK', 'max:255'],
            'about' => ['nullable', 'string', 'max:16383'],
            'subscribed' => ['nullable', 'boolean'],
        ]);
    }

    protected function emailValidator(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'email' => ['required', 'max:200', 'regex:/^[^@]+$/'],
            'domain' => ['required', Rule::in($this->allowedDomains)]
        ]);
    }

    protected function motivationValidator(array $data): Validator
    {
        return ValidatorFacade::make($data, [
            'motivation' => ['required', 'string', 'max:16383'],
        ]);
    }
}
