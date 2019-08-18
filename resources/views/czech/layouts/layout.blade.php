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

        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />
        @section('stylesheets')
            <link href="{{ mix('css/czech.css') }}" rel="stylesheet" type="text/css" />
        @show
    </head>
    <body>
        @include('partials.google-analytics')

        @section('header')
            <div class="header-wrapper">
                @include('czech.layouts.header')
            </div>
        @show

        <main class="site-wrapper">
            @yield('page')
        </main>

        <div class="footer-wrap">
            @include('czech.layouts.footer')
        </div>
        @section('javascript')
            <script src="{{ mix('js/czech.js') }}"></script>
        @show
    </body>
</html>
