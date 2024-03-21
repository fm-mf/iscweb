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
        // Do not change the locale for parts without multi-language support,
        // otherwise there would be a mix of languages on non-translated pages
        if (
            !$request->is('muj-buddy', 'muj-buddy/*')
            && !$request->routeIs('tandem.*')
            && !$request->is('user', 'user/*')
            && (!$request->routeIs('partak.*') || $request->user()->buddy->agreedPrivacyPartak())
        ) {
            setlocale(LC_ALL, __('web.locale-full'));
            return $next($request);
        }

        if ($request->routeIs('tandem.*')) {
            $sessionKey = LocaleHelper::SESSION_KEY_TANDEM;
            $guard = 'tandem';
        }

        $language = $this->handleLocale(
            $sessionKey ?? LocaleHelper::SESSION_KEY,
            $guard ?? null
        );

        app()->setLocale($language);
        setlocale(LC_ALL, __('web.locale-full'));

        return $next($request);
    }

    protected function handleLocale(string $sessionKey, ?string $guard = null): string
    {
        $browserPreferredLanguage = LocaleHelper::getBrowserPreferredLanguage();
        $sessionLanguage = session($sessionKey, $browserPreferredLanguage);

        if (
            auth($guard)->check()
            && ($userPreferredLanguage = auth($guard)->user()->preferred_language) !== $sessionLanguage
        ) {
            session([
                $sessionKey => $userPreferredLanguage ?? $sessionLanguage,
            ]);
        }

        return session($sessionKey, $browserPreferredLanguage);
    }
}
