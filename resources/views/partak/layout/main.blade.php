@extends('layouts.master')

@section('stylesheets')
    <link href="{{ mix('css/partaknet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fa/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    @section('header')
        @include("partak.layout.navigation")
    @show

    <main class="site-wrapper">
        @yield('page')
        
        <div id="push"></div>
    </main>

    <div class="footer-wrapper" id="footer">
        <div class="container">
            <div class="row footer">
                <div class="col-sm-12 align-center">
                    &copy; International Student Club CTU in Prague, z.s. | za stránku zodpovídá Quality & Knowledge Manager (<a href="mailto:knowledge@isc.cvut.cz">knowledge@isc.cvut.cz</a>)
                </div>
            </div>
        </div>
    </div>

    @include('footer')
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
@endsection
