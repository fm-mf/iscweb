<?php

namespace App\Http\Controllers\Buddyprogram;

use App\Http\Controllers\Controller;
use App\Models\Buddy;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $buddy = auth()->user()->buddy;

        return view('buddyprogram.my-profile')->with([
            'faculties' => Faculty::getOptions(),
            'avatar' => $buddy->person->avatar(),
            'buddy' => $buddy
        ]);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->validate([
            'phone' => ['max:20'],
            'age' => ['integer', 'min:1901', 'max:2155', 'nullable'],
            'subscribed' => ['boolean', 'nullable'],
            'sex' => ['required', 'string', 'in:M,F'],
            'id_faculty' => ['required', 'int', 'exists:faculties'],
        ]);

        if (!isset($data['subscribed'])) {
            $data['subscribed'] = false;
        }

        $buddy = auth()->user()->buddy;
        $buddy->person->update($data);
        $buddy->update($data);

        return redirect()->route('buddy-my-profile')
            ->with(['success' => __('buddy-program.my-profile.profile-updated')]);
    }

    public function changePassword(Request $request)
    {
        $data = $request->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = auth()->user();
                    if (!Hash::check(User::encryptPassword($user->email, $value), $user->password)) {
                        $fail(__('buddy-program.my-profile.wrong-old-password'));
                    }
                }
            ],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        $user->forceFill([
            'password' => Hash::make(User::encryptPassword($user->email, $data['new_password']))
        ])->save();

        return redirect()->route('buddy-my-profile')
            ->with(['success' => __('buddy-program.my-profile.password-changed')]);
    }

    public function setLocale(Request $request)
    {
        $data = $request->validate([
            'locale' => ['string', 'in:en,cs']
        ]);

        Session::put('locale', $data['locale']);

        return back();
    }
}
