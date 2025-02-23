<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CheckPartak
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/user');
        }

        if (!$request->user()->isPartak()) {
            return redirect('/');
        }

        if (!$request->user()->buddy->agreedPrivacyPartak()) {
            //return redirect('/privacy/partak');
            return new Response(view('web.privacy.privacy-partak'));
        }

        return $next($request);
    }
}
