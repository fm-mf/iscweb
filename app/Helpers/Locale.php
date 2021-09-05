<?php

namespace App\Helpers;

class Locale
{
    const AVAILABLE_LOCALES = [
        'en',
        'cs',
    ];

    const SESSION_KEY = 'locale';

    const SESSION_KEY_TANDEM = 'locale_tandem';

    public static function getAvailableLocalesSelectOptions(): array
    {
        return [
            'cs' => __('formatting.lang-select-option', [
                'native' => __('languages.cs', [], 'cs'),
                'en' => __('languages.cs', [], 'en'),
            ]),
            'en' => __('languages.en', [], 'en'),
        ];
    }

    public static function getBrowserPreferredLanguage(): string
    {
        $browserPreferredLanguage = request()->getPreferredLanguage(self::AVAILABLE_LOCALES);

        // Override for Slovak language to show Czech translation
        if (
            $browserPreferredLanguage === self::AVAILABLE_LOCALES[0] &&
            request()->getPreferredLanguage(array_merge(['sk'], self::AVAILABLE_LOCALES)) === 'sk'
        ) {
            $browserPreferredLanguage = 'cs';
        }

        return $browserPreferredLanguage;
    }

    public static function setUserPreferredLanguage(string $language)
    {
        session([
            self::SESSION_KEY => $language,
        ]);

        if (auth()->check()) {
            auth()->user()->buddy->update([
                'preferred_language' => $language,
            ]);
        }
    }
}
