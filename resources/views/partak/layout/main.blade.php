@extends('layouts.master')

@section('stylesheets')
    <!-- TODO: Use locally -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link href="{{ mix('css/partaknet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fa/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">
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

