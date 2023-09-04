<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <title>@lang('emails.welcome.title')</title>
    </head>
    <body>
        <h1>@lang('emails.welcome.title')</h1>
        @lang('emails.welcome.body', [
            'buddyDbUrl' => route('buddy-home'),
        ])
    </body>
</html>
