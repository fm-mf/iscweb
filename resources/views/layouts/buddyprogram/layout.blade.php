<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}" />

    <title>Buddy Program | ISC CTU in Prague</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    @section('stylesheets')
        <link rel="stylesheet" type="text/css" href="{{ mix('css/buddyprogram.css') }}" />
    @show
</head>
<body>
@include('partials.google-analytics')

<!-- example 7 - center on mobile 2-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="d-flex flex-grow-1">
        <span class="w-100 d-lg-none d-block"><!-- hidden spacer to center brand on mobile --></span>
        <a class="navbar-brand" href="{{route('buddy-home')}}">
            <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}"  alt="International Student Club">
        </a>
        <div class="w-100 text-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="collapse navbar-collapse flex-grow-1 " id="navbar">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}">
                    <i class="fas fa-users"></i> Volní studenti
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Buddyprogram\ListingController@listMyStudents') }}">
                    <i class="fas fa-user-friends"></i> Moji studenti
                </a>
            </li>
            {{--<li><a n:href="Homepage:arrivals"><img src="{$basePath}/img/arrivals.png"><br>PŘÍJEZDY</a></li>--}}
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Auth\ProfileController@showProfileForm') }}">
                    <i class="fas fa-user"></i> Můj profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ action('Auth\LoginController@logout') }}">
                    <i class="fas fa-sign-out-alt"></i> Odhlásit se
                </a>
            </li>
        </ul>
    </div>
</nav>

<main class="container-fluid">
    @yield('content')
</main>

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
@show
</body>
</html>
