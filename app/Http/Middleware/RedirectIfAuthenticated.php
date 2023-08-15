<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();

                if ($guard === 'tandem') {
                    return redirect(route('tandem.main'));
                }

                if ($user->isPartak()) {
                    return redirect('/partak');
                } elseif ($user->isDegreeStudent()) {
                    return redirect()->route('auth.profile.edit');
                } elseif ($user->isBuddy() || $user->isDegreeBuddy()) {
                        return redirect('/muj-buddy');
                } else {
                    return redirect('/user/verify');
                }
            }
        }

        return $next($request);
    }
}
