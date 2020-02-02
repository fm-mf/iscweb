@extends('layouts.master')

@section('title', 'Tandem Database')

@section('content')
    <div class="d-flex flex-column min-vh-100">
        @section('header')
            <div class="header-wrapper">
                @include('tandem.layouts.header')
            </div>
        @show

        <main class="site-wrapper flex-grow-1">
            @yield('page')
        </main>

        <div class="footer-wrap">
            @include('tandem.layouts.footer')
        </div>
    </div>
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/web.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/tandem.css') }}" />
@endsection

@section('scripts')
    <script type="application/javascript" src="{{ mix('js/web.js') }}" defer="defer"></script>
    <script type="application/javascript" src="{{ mix('js/tandem.js') }}" defer="defer"></script>
@endsection
