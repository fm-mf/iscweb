@extends('layouts.master')

@section('stylesheets')
    <link href="{{ mix('css/czech.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @section('header')
        <div class="header-wrapper">
            @include('czech.layouts.header')
        </div>
    @show

    <main class="site-wrapper">
        @yield('page')
    </main>

    <div class="footer-wrap">
        @include('czech.layouts.footer')
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/czech.js') }}" defer="defer"></script>
@endsection
