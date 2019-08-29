<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hassection('title')
            <title>@yield('title') | {{ $shortName }}</title>
        @else
            <title>{{ $fullName }}</title>
        @endif

        <meta property="og:title" content="{{ $fullName }}" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="{{ url('') }}" />
        <meta property="og:image" content="{{ asset('/img/isc-web.jpg') }}" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />
        @yield('stylesheets')
    </head>
    <body>
        @include('partials.google-analytics')
        @yield('content')
        @yield('scripts')
    </body>
</html>
