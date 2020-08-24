<?php

namespace App\Http\Controllers\Tandem;

use App\Helpers\Locale;
use App\Http\Controllers\Controller;
use App\Models\TandemUser;
use Illuminate\Database\Eloquent\Collection;

class TandemController extends Controller
{
    public function index()
    {
        return view('tandem.index');
    }

    public function main()
    {
        $user = auth('tandem')->user();

        if (request()->has('showAll')) {
            $potentialPartners = Collection::make();
        } else {
            $potentialPartners = $user->potentialPartners;
        }

        return view('tandem.main')->with([
            'showAll' => request()->has('showAll'),
            'potentialPartners' => $potentialPartners,
            'otherActiveUsers' => TandemUser::active()->withLanguages()->orderByRecentLogin()->get()->diff($potentialPartners),
        ]);
    }

    public function profile(TandemUser $tandemUser)
    {
        return view('tandem.profile')->with(compact('tandemUser'));
    }

    public function changeLanguage()
    {
        request()->validate([
            'language' => [
                'required',
                'in:' . implode(',', Locale::AVAILABLE_LOCALES)
            ],
        ]);

        if (auth('tandem')->check()) {
            auth('tandem')->user()->update([
                'preferred_language' => request('language'),
            ]);
        }

        session([
            Locale::SESSION_KEY_TANDEM => request('language'),
        ]);

        return back();
    }
}
