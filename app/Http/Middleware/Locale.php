<?php

namespace App\Http\Middleware;

use App\Helpers\Locale as LocaleHelper;
use Closure;
use Illuminate\Http\Request;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Set locale only for Buddy DB, otherwise there will be a mix of languages on non-translated pages
        if (!$request->is('muj-buddy') && !$request->is('muj-buddy/*')) {
            return $next($request);
        }

        $browserPreferredLanguage = LocaleHelper::getBrowserPreferredLanguage();

        if (auth()->guest() && session(LocaleHelper::SESSION_KEY) !== $browserPreferredLanguage) {
            session([
                LocaleHelper::SESSION_KEY => $browserPreferredLanguage,
            ]);
        } elseif (auth()->user() && session(LocaleHelper::SESSION_KEY, $browserPreferredLanguage) !== auth()->user()->preferred_language) {
            session([
                LocaleHelper::SESSION_KEY => auth()->user()->preferred_language ?? $browserPreferredLanguage,
            ]);
        }

        $language = session(
            LocaleHelper::SESSION_KEY,
            $browserPreferredLanguage
        );

        app()->setLocale($language);
        setlocale(LC_ALL, __('web.locale-full'));

        return $next($request);
    }
}
