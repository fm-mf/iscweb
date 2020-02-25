@extends('layouts.master')

@section('stylesheets')
    <link href="{{ mix('css/vendor.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ mix('css/czech.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="d-flex flex-column min-vh-100">
        @section('header')
            <div class="header-wrapper">
                @include('czech.layouts.header')
            </div>
        @show

        <main class="site-wrapper flex-grow-1">
            @yield('page')
        </main>

        <div class="footer-wrap">
            @include('czech.layouts.footer')
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/web.js') }}" defer="defer"></script>
@endsection
