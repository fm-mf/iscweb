<?php

namespace App\Http\Controllers\Tandem;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Language;
use Laracasts\Utilities\JavaScript\JavaScriptFacade as JavaScript;

class TandemProfileController extends Controller
{
    public function edit()
    {
        JavaScript::put([
            'initValues' => [
                'country' => old('country', auth('tandem')->user()->country),
                'languagesToLearn' => old('languagesToLearn', auth('tandem')->user()->languagesToLearn),
                'languagesToTeach' => old('languagesToTeach', auth('tandem')->user()->languagesToTeach),
            ]
        ]);

        return view('tandem.my-profile')->with([
            'tandemUser' => auth('tandem')->user(),
            'countries' => Country::all(),
            'languages' => Language::all(),
        ]);
    }

    public function update()
    {
        $data = request()->validate([
            'last_name' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'integer', 'exists:countries,id_country'],
            'about' => ['nullable', 'string'],
            'languagesToTeach' => ['required', 'array', 'min:1', 'exists:languages,id_language'],
            'languagesToLearn' => ['required', 'array', 'min:1', 'exists:languages,id_language'],
        ]);

        $user = auth('tandem')->user();
        $user->update([
            'last_name' => $data['last_name'],
            'about' => $data['about'],
            'id_country' => $data['country'],
        ]);
        $user->languagesToTeach()->sync($data['languagesToTeach']);
        $user->languagesToLearn()->sync($data['languagesToLearn']);

        return back()->with(['updateSuccessful' => true]);
    }

    public function delete()
    {
        $user = auth('tandem')->user();
        auth('tandem')->logout();
        $user->languagesToTeach()->detach();
        $user->languagesToLearn()->detach();
        $user->delete();

        return redirect()->route('tandem.index')->with([
            'accountDeleteSuccessful' => true,
        ]);
    }
}
