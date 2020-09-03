@extends('layouts.master')

@section('stylesheets')
    <link href="{{ mix('css/partaknet.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('fa/css/fontawesome-all.min.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <div class="site-wrapper">
        @section('header')
            @include("partak.layout.navigation")
        @show

        <div class="content-wrapper">
            <div class="headbox">
                <span class="flex-grow-1 w-100"></span>

                <div class="d-flex align-items-center p-3 flex-grow-1">
                    <h1 class="p-0 mx-auto my-0">ParťákNet</h1>
                </div>

                <div class="flex-grow-1 w-100 d-flex">
                    <div class="dropdown userbox ml-auto">
                        <a href="#" class="dropdown-toggle btn" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ URL::asset( Auth::user()->person->avatar() ) }}" class="img-circle top-navigation-user" /> {{ Auth::user()->person->getFullname() }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenuLink">
                            <a class="dropdown-item" href="{{ url('user/logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <main>
                @if(session('AlertMessage'))
                    <div class="alert alert-danger">
                        <span class="fas fa-exclamation-triangle"></span> {{ session('AlertMessage') }}
                    </div>
                @endif

                @yield('page')
            </main>

            <div class="footer" id="footer">
                <div class="container mb-0 text-center p-3">
                    &copy; {{ $officialName }} | za stránku zodpovídá Quality & Knowledge Manager (<a href="mailto:knowledge@isc.cvut.cz">knowledge@isc.cvut.cz</a>)
                </div>
            </div>
        </div>
    </div>

    @include('footer')
@endsection

@section('scripts')
    <script src="{{ asset('js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.4.min.js') }}"></script>
@endsection
