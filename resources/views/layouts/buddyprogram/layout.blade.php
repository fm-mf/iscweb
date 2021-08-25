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
                 ['title' => __('buddy-program.available-students'), 'route' => 'buddy-home', 'icon' => 'fas fa-fw fa-users'],
                 ['title' => __('buddy-program.my-students'), 'route' => 'buddy-my-students', 'icon' => 'fas fa-fw fa-user-friends'],
                 app()->isLocale('cs')
                    ? ['title' => __('buddy-program.buddy-handbook'), 'route' => 'buddy-handbook-cs', 'icon' => 'fas fa-fw fa-file-pdf', 'target' => '_blank']
                    : null,
            ]])
                <li class="nav-item dropdown{{ request()->routeIs('buddy-my-profile') ? ' active' : '' }}">
                    <a href="#" class="nav-link dropdown-toggle" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth()->user()->person->avatar_url }}" alt="" class="user-menu-avatar" />
                        {{ auth()->user()->person->first_name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenuLink">
                        <a href="{{ route('buddy-my-profile') }}" class="dropdown-item{{ request()->routeIs('buddy-my-profile') ? ' active' : '' }}">
                            <i class="fas fa-fw fa-user"></i>
                            @lang('buddy-program.my-profile.title')
                        </a>
                        <div class="dropdown-divider"></div>
                        @if(auth()->user()->isPartak())
                            <a href="{{ route('partak.index') }}" target="_blank" class="dropdown-item">
                                <i class="fas fa-fw fa-external-link-alt"></i>
                                ParťákNet
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="dropdown-item">
                            <i class="fas fa-fw fa-sign-out-alt"></i>
                            @lang('buddy-program.logout')
                        </a>
                    </div>
                </li>
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
