@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/web.css') }}" />
@endsection

@section('content')
    @section('header')
        <div class="header-wrapper">
            @include('web.layouts.header')
        </div>
    @show

    <main class="site-wrapper">
        @yield('page')
    </main>

    <div class="footer-wrap">
        @include('web.layouts.footer')
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/web.js') }}" defer="defer"></script>
@endsection
