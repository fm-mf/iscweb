<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
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
