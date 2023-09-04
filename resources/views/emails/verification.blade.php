<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <title>@lang('emails.verification.title')</title>
    </head>
    <body>
        <h1>@lang('emails.verification.title')</h1>
        @lang('emails.verification.body', [
            'url' => route('auth.verification.verify', ['hash' => $person->user->hash]),
        ])
    </body>
</html>
