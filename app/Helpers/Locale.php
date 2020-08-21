<?php

namespace App\Helpers;

class Locale
{
    const AVAILABLE_LOCALES = [
        'en',
        'cs',
    ];

    const SESSION_KEY = 'locale';

    public static function getAvailableLocalesSelectOptions()
    {
        return [
            'cs' => __('formatting.lang-select-option', [
                'native' => __('languages.cs', [], 'cs'),
                'en' => __('languages.cs', [], 'en'),
            ]),
            'en' => __('languages.en', [], 'en'),
        ];
    }
}
