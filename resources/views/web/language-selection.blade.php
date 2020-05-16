@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/vendor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/web.css') }}" />
@endsection

@section('scripts')
    <script src="{{ mix('js/web.js') }}" defer="defer"></script>
@endsection

@section('content')
    <header class="lang-select">
        <div class="navbar navbar-dark">
            <div class="container">
                <div class="d-flex flex-grow-1 align-items-center">
                    <span class="w-100 d-lg-none"></span>
                    <a class="navbar-brand" href="{{ route('web.lang-select') }}">
                        <img src="{{ asset('img/logos/isc-logo-white-color-horizontal.svg') }}" alt="Logo ISC CTU in Prague" />
                    </a>
                    <span class="w-100 text-right"></span>
                </div>
            </div>
        </div>
        <nav>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <h1>{{ $fullName }}</h1>
                        <p>To continue, please, select whether you are an exchange student or a Czech student</p>
                    </div>
                </div>
                <ul class="row list-unstyled">
                    <li class="col-md-6">
                        <a href="{{ route('web.index') }}">
                            <span>
                                <img src="{{ asset('img/flags/flag-gbr.svg') }}" alt="Continue to information for Exchange students" />
                            </span>
                            Exchange student
                        </a>
                    </li>
                    <li class="col-md-6">
                        <a href="{{ route('czech.index') }}">
                            <span>
                                <img src="{{ asset('img/flags/flag-cze.svg') }}" alt="Continue to information for Czech buddies" />
                            </span>
                            Czech student
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="row justify-content-center align-items-stretch align-content-center logos">
                <div class="col-auto">
                    <a href="https://www.esn.org" class="logo" target="_blank" rel="noopener">
                        <img src="{{ asset('img/logos/esn/esn-logo-white.svg') }}" alt="Logo of Erasmus Student Network" />
                    </a>
                    <a href="https://www.cvut.cz" class="logo logo-cvut" target="_blank" rel="noopener">
                        <img src="{{ asset('img/logos/cvut/logo_CVUT_negativ.svg') }}" alt="Logo of Czech Technical University in Prague" />
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="footer-wrap">
        <footer class="container">
            <div class="row justify-content-center">
                <div class="col-12" style="text-align: center">
                    <p>&copy; {{ \Carbon\Carbon::today()->year }} | {{ $officialName }}</p>
                </div>
            </div>
        </footer>
    </div>
@endsection
