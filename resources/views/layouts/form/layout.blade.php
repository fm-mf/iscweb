<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Buddy Program</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    <script src="https://kit.fontawesome.com/ff34153e60.js"></script>

    @section('stylesheets')
        <link href="{{ URL::asset('css/form.css') }}" rel="stylesheet" type="text/css">
    @show

{{-- We do not use Proxima Nova or Myriad Pro fonts from Typekit anymore
    <script type="text/javascript" src="//use.typekit.net/aav2ndi.js"></script>
    <script type="text/javascript">try{ Typekit.load();}catch(e){}</script>--}}
</head>
<body>
@include('partials.google-analytics')

<main>
  @yield('content')
</main>

@section('scripts')
  <script src="{{ asset('js/form.js') }}"></script>
@show

</body>
</html>
