<?php

namespace App\Http\Controllers\Tandem\Auth;

use App\Rules\TandemPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TandemChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:tandem');
    }

    public function showChangePasswordForm()
    {
        return view('tandem.auth.passwords.change');
    }

    public function changePassword()
    {
        request()->validate([
            'current_password' => ['required', 'string', new TandemPassword()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $tandemUser = auth('tandem')->user();
        $tandemUser->setNewPassword(request('password'));

        return redirect()->route('tandem.my-profile')->with([
            'passwordChangeSuccessful' => true,
        ]);
    }
}
