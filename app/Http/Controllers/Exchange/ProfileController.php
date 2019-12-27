<?php

namespace App\Http\Controllers\Exchange;

use App\Models\Accommodation;
use App\Models\Arrival;
use App\Models\ExchangeStudent;
use App\Models\Person;
use App\Models\Transportation;
use App\Models\Trip;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showProfileForm($hash)
    {
        $user = User::findByHash($hash);
        $student = ExchangeStudent::with('person')->find($user->id_user);

        $accommodations = [];
        foreach (Accommodation::all() as $accommodation) {
            $accommodations[$accommodation->id_accommodation] = $accommodation->full_name_eng;
        }

        $transportations = [];
        foreach (Transportation::all() as $transportation) {
            $transportations[$transportation->id_transportation] = $transportation->eng;
        }

        $currentTransportation = null;
        $currentTime = null;
        $currentDate = null;
        if ($student->arrival) {
            $currentTransportation = $student->arrival->transportation->id_transportation;
            $date = $student->arrival->arrival;
            $currentTime = $date->format('g:i A');
            $currentDate = $date->format('d M Y');
        }

        $avatar = $student->person->avatar();

        //dd($avatar);

        return view('exchange.profile')->with([
            'student' => $student,
            'hash' => $hash,
            'avatar' => $avatar,
            'accommodations' => $accommodations,
            'transportations' => $transportations,
            'currentTransportation' => $currentTransportation,
            'currentDate' => $currentDate,
            'currentTime' => $currentTime,
            'wantsPresent' => $student->wants_present == 'y',
            'optedOut' => $student->want_buddy == 'n',
            'userHash' => $student->person->user->hash,
            'diets' => Person::getAllDiets(),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $this->profileValidator($request->all())->validate();
        $user = User::findByHash($request->hash);

        if ($user === null) {
            return redirect('/');
        }

        $student = ExchangeStudent::find($user->id_user);
        $student->about = $request->about;
        $student->id_accommodation = $request->accommodation;
        $student->whatsapp = $request->whatsapp;
        $student->facebook = $request->facebook;

        if (!$request->arrival_skipped && $request->date && $request->transportation) {
            $arrival = $student->arrival;
            if (!$arrival) {
                $arrival = new Arrival();
                $arrival->id_user = $user->id_user;
            }
            $arrival->id_transportation = $request->transportation;
            $time = $request->time ? $request->time : "00:00 AM";
            $arrival->arrival = Carbon::createFromFormat('d M Y g:i A', $request->date . ' ' . $time);

            $arrival->save();
        } elseif ($student->arrival) {
            $student->arrival->delete();
        }

        if ($request->wants_present) {
            $student->wants_present = 'y';
        } else {
            $student->wants_present = 'n';
        }

        if ($request->opt_out) {
            $student->want_buddy = 'n';
        } else {
            $student->want_buddy = 'y';
        }

        $student->privacy_policy = $request->privacy_policy;

        $student->save();
        $student->person->updateWithIssuesAndDiet([
            'medical_issues' => $request->medical_issues,
            'diet' => $request->diet == '' ? null : $request->diet,
        ]);

        return redirect('/exchange/'.$request->hash)->with('success', true);
    }

    public function showFlagParade($hash)
    {
        $user = User::where('hash', $hash)->exists();
        if ($user) {
            $signIn = Trip::wherehas('event', function ($query) {
                $query->where('name', 'Flag Parade');
            })->whereHas('participants.user', function ($query) use ($hash) {
                $query->where('hash', $hash);
            })->exists();
            return view('exchange.FlagParadeRegistration')->with([
                'hash' => $hash,
                'signIn' => $signIn,
            ]);
        }
        return view('errors.unauthorized');
    }

    public function singUpFlagParade($hash)
    {
        $user = User::where('hash', $hash)->first();
        $trip = Trip::whereHas('event', function ($query) {
            $query->where('name', 'Flag Parade');
        })->first();
        $trip->addParticipant($user->id_user, null);
        return \redirect()->action('Exchange\ProfileController@showFlagParade', [
            'hash' => $user->hash,
        ]);
    }

    public function deleteFlagParade($hash)
    {
        $trip = Trip::whereHas('event', function ($query) {
            $query->where('name', 'Flag Parade');
        })->first();
        $user = User::where('hash', $hash)->first();
        $trip->removeParticipant($user->id_user);
        return \redirect()->action('Exchange\ProfileController@showFlagParade', [
            'hash' => $user->hash,
        ]);
    }

    protected function profileValidator(array $data)
    {
        $fbProfileUrlRegex = '/^(https?:\/\/)?((www|m)\.)?(facebook|fb)(\.(com|me))\/(profile\.php\?id=[0-9]+(&[^&]*)*|(?!profile\.php\?)([a-zA-Z0-9][.]*){4,}[a-zA-Z0-9]+\/?(\?.*)?)$/';

        return Validator::make($data, [
            'date' => 'required_without_all:arrival_skipped,opt_out|date_format:d M Y',
            'time' => 'date_format:g:i A',
            'transportation' => 'required_without_all:arrival_skipped,opt_out',
            'privacy_policy' => 'accepted',
            'accommodation' => ['required', 'exists:accommodation,id_accommodation'],
            'whatsapp' => ['phone:AUTO', 'nullable'],
            'facebook' => ["regex:$fbProfileUrlRegex", 'nullable'],
        ]);
    }
}
