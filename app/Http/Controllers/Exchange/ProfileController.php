<?php

namespace App\Http\Controllers\Exchange;

use App\Models\Accommodation;
use App\Models\Arrival;
use App\Models\ExchangeStudent;
use App\Models\Transportation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showProfileForm($hash)
    {
        $user = User::findByHash($hash);
        $student = ExchangeStudent::find($user->id_user);

        $accommodations = [];
        foreach (Accommodation::all() as $accommodation) {
            $accommodations[$accommodation->id_accommodation] = $accommodation->full_name_eng;
        }

        $transportations = [];
        foreach(Transportation::all() as $transportation) {
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
            'optedOut' => $student->want_buddy == 'n',
            'userHash' => $student->person->user->hash,
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
        } else if ($student->arrival) {
            $student->arrival->delete();
        }

        if ($request->opt_out) {
            $student->want_buddy = 'n';
        } else {
            $student->want_buddy = 'y';
        }

        $student->save();

        return redirect('/exchange/'.$request->hash)->with('success', true);

    }

    protected function profileValidator(array $data)
    {
        return Validator::make($data, [
            'date' => 'required_without_all:arrival_skipped,opt_out|date_format:d M Y',
            'time' => 'date_format:g:i A',
            'transportation' => 'required_without_all:arrival_skipped,opt_out',
        ]);
    }
}
