<!DOCTYPE html>
<html lang="@yield('lang')">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>@yield('title')S ČVUT do světa | {{ $shortName }}</title>

        @section('stylesheets')
            <link href="{{ URL::asset('css/saf.css') }}" rel="stylesheet" type="text/css" />
        @show

        <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" />
    </head>
    <body>
        <noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MPBKF8" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <script>(function(w,d,s,l,i){ w[l]=w[l]||[];w[l].push({ 'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MPBKF8');</script>

        @yield('page')

        @include('layouts.saf.footer')

        @section('scripts')
        @show
    </body>
</html>
