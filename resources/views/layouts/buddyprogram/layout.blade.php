<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}" />

    <title>Buddy Program | ISC CTU in Prague</title>

    <link rel="icon" type="image/vnd.microsoft.icon" href="{{ asset('img/favicon.ico') }}" sizes="16x16 32x32 64x64" />

    @section('stylesheets')
        <link rel="stylesheet" type="text/css" href="{{ mix('css/vendor.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ mix('css/buddyprogram.css') }}" />
    @show
</head>
<body>
@include('partials.google-analytics')

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="d-flex flex-grow-1 align-items-center">
            <span class="w-100 d-lg-none d-block"></span>
            <a class="navbar-brand" href="{{ route('buddy-home') }}">
                <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}"  alt="{{ $shortName }}" />
            </a>
            <div class="w-100 text-right">
                <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
        <div class="collapse navbar-collapse flex-grow-1 " id="navbar">
            @component('web.components.navbar-nav', [ 'navItems' => [
                 ['title' => __('buddy-program.available-students'), 'route' => 'buddy-home', 'icon' => 'fas fa-users'],
                 ['title' => __('buddy-program.my-students'), 'route' => 'buddy-my-students', 'icon' => 'fas fa-user-friends'],
                 ['title' => __('buddy-program.my-profile.title'), 'route' => 'buddy-my-profile', 'icon' => 'fas fa-user'],
                 ['title' => __('buddy-program.logout'), 'route' => 'logout', 'icon' => 'fas fa-sign-out-alt'],
            ]])
            @endcomponent
            <ul class="navbar-nav lang-switcher">
                <li class="nav-item">
                    <a class="nav-link btn" href="{{ route('buddy.change-language', ['language' => app()->getLocale() === 'en' ? 'cs' : 'en']) }}">
                        @if(app()->getLocale() === 'en')
                            <img src="{{ asset('img/flags/flag-cze.svg') }}" alt="@lang('buddy-program.change-language', [], 'cs')" />
                        @else
                            <img src="{{ asset('img/flags/flag-gbr.svg') }}" alt="@lang('buddy-program.change-language', [], 'en')" />
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<main class="container-fluid">
    @yield('content')
</main>

@section('scripts')
    <script src="{{ asset('js/jquery.slim.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/bootstrap.4.min.js') }}" defer="defer"></script>
@show
</body>
</html>
