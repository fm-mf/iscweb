@extends('layouts.user.layout')
@section('page')
<div class="register-wrapper">
    <div class="form-wrapper container container-form">
        <header class="row align-items-center">
            <div class="col-md-6 logo-container text-md-right text-center">
                <img src="{{ URL::asset('img/logos/isc-logo-color-horizontal.svg') }}" alt="International Student Club" class="logo">
            </div>
            <div class="col-md-6 title-container">
                @yield('title', 'Buddy Program')
            </div>
        </header>
        @yield('content')
    </div>
</div>
@stop
