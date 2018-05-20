<?php
/**
 * Created by PhpStorm.
 * User: Martin
 * Date: 20.01.2017
 * Time: 18:15
 */

namespace App\Http\Controllers\Privacy;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class PrivacyController extends Controller
{
    public function showTree()
    {
        return view('web.privacy.tree');
    }

    public function showPrivacyNotice()
    {
        return view('web.privacy.privacy-notice');
    }

    public function showPrivacyPolicy()
    {
        return view('web.privacy.privacy-policy');
    }

    public function showAgreementCS()
    {
        return view('web.privacy.agreement-cs');
    }

    public function privacyPartak(Request $request)
    {
        $redirect = $this->notPartakRedirect($request);
        if ($redirect) return $redirect;

        $request->user()->buddy()->setAgreedPrivacyPartak();
        return redirect($request->headers->get('referer'));
    }

    protected function notPartakRedirect(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/user');
        }

        if (!$request->user()->isPartak()) {
            return redirect('/');
        }

        if ($request->user()->buddy()->agreedPrivacyPartak()) {
            return redirect('/partak');
        }
    }
}
