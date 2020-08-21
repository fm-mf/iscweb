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
        if (auth()->user()) {
            session([
                LocaleHelper::SESSION_KEY => auth()->user()->preferred_language ?? LocaleHelper::AVAILABLE_LOCALES[0],
            ]);
        }

        $language = session(
            LocaleHelper::SESSION_KEY,
            $request->getPreferredLanguage(LocaleHelper::AVAILABLE_LOCALES)
        );

        app()->setLocale($language);
        setlocale(LC_ALL, __('web.locale-full'));

        return $next($request);
    }
}
