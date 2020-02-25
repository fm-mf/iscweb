@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/vendor.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/web.css') }}" />
@endsection

@section('content')
    <div class="d-flex flex-column min-vh-100">
        @section('header')
            <div class="header-wrapper">
                @include('web.layouts.header')
            </div>
        @show

        <main class="site-wrapper flex-grow-1">
            @yield('page')
        </main>

        <div class="footer-wrap">
            @include('web.layouts.footer')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/web.js') }}" defer="defer"></script>
@endsection
