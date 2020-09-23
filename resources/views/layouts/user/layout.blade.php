<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buddy Program</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    @section('stylesheets')
        <link href="{{ mix('css/user.css') }}" rel="stylesheet" type="text/css">
    @show

{{-- We do not use Proxima Nova or Myriad Pro fonts from Typekit anymore
    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>--}}
</head>
<body>
@include('partials.google-analytics')

@yield('page')

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" defer="defer"></script>
@show

</body>
</html>
