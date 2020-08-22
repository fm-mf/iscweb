<?php

namespace App\Http\Controllers\Tandem;

use App\Helpers\Locale;
use App\Http\Controllers\Controller;

class TandemController extends Controller
{
    public function index()
    {
        return view('tandem.index');
    }

    public function main()
    {
        return view('tandem.main');
    }

    public function profile()
    {
        return view('tandem.profile');
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
