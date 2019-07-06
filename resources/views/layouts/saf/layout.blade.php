<!DOCTYPE html>
<html lang="@yield('lang')">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>@yield('title')S ČVUT do světa | {{ $shortName }}</title>

        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />
        @section('stylesheets')
            <link href="{{ URL::asset('css/saf.css') }}" rel="stylesheet" type="text/css" />
        @show

    </head>
    <body>
        @include('partials.google-analytics')

        @yield('page')

        @include('layouts.saf.footer')

        @section('scripts')
        @show
    </body>
</html>
