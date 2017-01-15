<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckBuddy
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
        if (!$request->user()->isBuddy()) {
            if ($request->user()->isUnverifiedBuddy()) {
                return redirect('/user/verify');
            } else {
                return redirect('/user');
            }
        }

        return $next($request);
    }
}
