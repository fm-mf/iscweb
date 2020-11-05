<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Helpers\Locale;
use App\Http\Controllers\Controller;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $buddy = auth()->user()->buddy;

        return view('buddyprogram.my-profile')->with([
            'faculties' => Faculty::getOptions(),
            'avatar' => $buddy->person->avatar(),
            'buddy' => $buddy,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'phone' => ['nullable', 'phone:AUTO,CZ,SK'],
            'age' => ['integer', 'min:1901', 'max:2155', 'nullable'],
            'subscribed' => ['boolean', 'nullable'],
            'sex' => ['required', 'string', 'in:M,F'],
            'id_faculty' => ['required', 'integer', 'exists:faculties'],
            'about' => ['nullable', 'string'],
        ]);

        if (!isset($data['subscribed'])) {
            $data['subscribed'] = false;
        }

        $buddy = auth()->user()->buddy;
        $buddy->update($data);
        $buddy->person->update($data);

        return redirect()->route('buddy-my-profile')
            ->with(['success' => __('buddy-program.my-profile.profile-updated', [], $buddy->preferred_language)]);
    }

    public function changePassword(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'old_password' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check(User::encryptPassword($user->email, $value), $user->password)) {
                        $fail(__('buddy-program.my-profile.wrong-old-password'));
                    }
                }
            ],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->forceFill([
            'password' => Hash::make(User::encryptPassword($user->email, $data['new_password']))
        ])->save();

        return redirect()->route('buddy-my-profile')
            ->with(['success' => __('buddy-program.my-profile.password-changed')]);
    }

    public function changeLanguage()
    {
        request()->validate([
            'language' => [
                'required',
                'in:' . implode(',', Locale::AVAILABLE_LOCALES)
            ],
        ]);

        if (auth()->check()) {
            auth()->user()->buddy->update([
                'preferred_language' => request('language'),
            ]);
        }

        session([
            Locale::SESSION_KEY => request('language'),
        ]);

        return back();
    }
}
