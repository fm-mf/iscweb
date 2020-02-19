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

@section('scripts')
    <!-- TODO: Use locally -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
@endsection
