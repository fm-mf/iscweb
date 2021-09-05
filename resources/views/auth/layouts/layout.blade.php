@extends('layouts.master')

@section('content')
    <div class="d-flex flex-column min-vh-100">
        @section('header')
            <div class="header-wrapper">
                @include('auth.layouts._header')
            </div>
        @show

        <main class="site-wrapper flex-grow-1 auth">
            <div class="container">
                @yield('page')
            </div>
        </main>

        <div class="footer-wrap">
            @include('auth.layouts._footer')
        </div>
    </div>
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/vendor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/general.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/auth.css') }}" />
@endsection

@section('scripts')
    <script src="{{ mix('js/jquery.min.js') }}" defer="defer"></script>
    <script src="{{ mix('js/popper.min.js') }}" defer="defer"></script>
    <script src="{{ mix('js/bootstrap.4.min.js') }}" defer="defer"></script>
@endsection
