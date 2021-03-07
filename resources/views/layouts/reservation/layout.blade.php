<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @section('title', "$event->name – Events | $shortName")
    <title>@yield('title')</title>
    <meta property="og:title" content="@yield('title')" />

    @section('description', str_limit(strip_tags($event->description), 160, "…"))
    <meta name="description" content="@yield('description')" />
    <meta property="og:description" content="@yield('description')" />

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    <link href="{{ asset('fa/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css" />

    @section('stylesheets')
        <link href="{{ mix('css/form.css') }}" rel="stylesheet" type="text/css" />
    @show

    @if($event->hasCover())
        <meta property="og:image" content="{{ $event->coverUrl }}" />
        <meta property="og:image:width" content="{{ getimagesize(public_path($event->coverPath))[0] }}" />
        <meta property="og:image:height" content="{{ getimagesize(public_path($event->coverPath))[1] }}" />
    @endif
</head>
<body>
@include('partials.google-analytics')

<main>
  @yield('content')
</main>

<div class="footer">
© {{ \Carbon\Carbon::now()->year }} | {{ $officialName }}
</div>


@section('scripts')
  <script src="{{ mix('js/reservation.js') }}"></script>
@show

@include ('footer')
</body>
</html>
