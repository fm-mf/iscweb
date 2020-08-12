<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Locale as GlobalLocale;

class Locale
{
    private $availableLocales = ["en", "cs"];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $language = $this->getRequestedLocale($request);

        if (Session::has('locale')) {
            $lang = Session::get('locale');
            if ($this->isValidLocale($lang)) {
                $language = $lang;
            }
        }

        app()->setLocale($language);

        return $next($request);
    }

    private function getRequestedLocale(Request $request)
    {
        $requestedLanguages = $request->getLanguages();

        while (count($requestedLanguages) > 0) {
            $lang = array_shift($requestedLanguages);
            if ($this->isValidLocale($lang)) {
                return $lang;
            }
        }

        return "en";
    }

    private function isValidLocale(string $lang)
    {
        return in_array($lang, $this->availableLocales);
    }
}
