@extends('layouts.user.layout')
@section('page')
<div class="register-wrapper">
    <div class="left-column"></div>
    <div class="form-wrapper container container-form">
        <img src="{{ URL::asset('img/web/logo.png') }}" alt="International Student Club" class="logo">
        @yield('content')
    </div>
</div>
@stop