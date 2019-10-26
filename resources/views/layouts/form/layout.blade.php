<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $event->name }} - ISC Events</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">

    @section('stylesheets')
      <link href="{{ mix('css/form.css') }}" rel="stylesheet" type="text/css">
    @show
</head>
<body>
@include('partials.google-analytics')

<main>
  @yield('content')
</main>

<div class="footer">
© 2019 | International Student Club CTU in Prague, z.s.
</div>


@section('scripts')
  <script src="{{ mix('js/form.js') }}"></script>
@show

@include ('footer')
</body>
</html>
