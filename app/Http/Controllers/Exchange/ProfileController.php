<?php

namespace App\Http\Controllers\Exchange;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExchangeProfileUpdateRequest;
use App\Models\Accommodation;
use App\Models\ExchangeStudent;
use App\Models\Transportation;
use App\Models\Trip;
use App\Models\User;

class ProfileController extends Controller
{
    public function show(ExchangeStudent $student)
    {
        return view('exchange.profile')->with([
            'student' => $student,
            'accommodations' => Accommodation::getOptions(),
            'transportations' => Transportation::getSelectOptionsArray(),
            'buddyDbFrom' => Settings::buddyDbFrom(),
        ]);
    }

    public function update(ExchangeProfileUpdateRequest $request, ExchangeStudent $student)
    {
        $student->update($request->validated());

        if ($request->arrival_skipped) {
            $student->arrival()->delete();
        } elseif (!$request->opt_out) {
            $student->arrival()->updateOrCreate([], $request->validated());
        }

        return redirect()->route('exchange.show', [$student->user->hash])->with('success', true);
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
}
