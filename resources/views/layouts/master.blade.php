<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @hassection('title')
            <title>@yield('title') | {{ $shortName }}</title>
            <meta property="og:title" content="@yield('title') | {{ $shortName }}" />
        @else
            <title>{{ $fullName }}</title>
            <meta property="og:title" content="{{ $fullName }}" />
        @endif

        @hassection('description')
            <meta name="description" content="@yield('description')" />
            <meta property="og:description" content="@yield('description')" />
        @else
            <meta name="description" content="{{ $shortName }} is a local section of Erasmus Student Network. We are volunteers taking care about Erasmus & Exchange students studying at the Czech Technical University in Prague." />
            <meta property="og:description" content="{{ $shortName }} is a local section of Erasmus Student Network. We are volunteers taking care about Erasmus & Exchange students studying at the Czech Technical University in Prague." />
        @endif

        @hassection('og-type')
            <meta property="og:type" content="@yield('og-title')" />
        @else
            <meta property="og:type" content="website" />
        @endif

        <meta property="og:url" content="{{ url()->current() }}" />

        @hassection('og-image')
            @yield('og-image')
        @else
            <meta property="og:image" content="{{ asset('img/web/isc-web-20.jpg') }}" />
            <meta property="og:image:width" content="{{ getimagesize(public_path('img/web/isc-web-20.jpg'))[0] }}" />
            <meta property="og:image:height" content="{{ getimagesize(public_path('img/web/isc-web-20.jpg'))[1] }}" />
        @endif

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 48x48" />
        @yield('stylesheets')
    </head>
    <body>
        @include('partials.google-analytics')
        @yield('content')
        @include('partials.logo-download-modal')
        @yield('scripts')
    </body>
</html>
