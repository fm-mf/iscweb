@extends('partak.layout.main')
@section('page')
<div class="dashboard-header">
<div class="dashboard-header-wrapper">
    <div class="container">
        <div class="row">
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse col-sm-9">
                <ul class="nav navbar-nav login-nav">
                    <li><a href="{{ url('user/logout') }}"><img src="{{ URL::asset('img/partak/log-out.png') }}" />Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
    <h1 class="title">Believe in ISC Spirit. Pass it on. <br>
        <small>ParťákNET je informačním centrem ISC</small></h1>

    <span class="show-menu"></span>
</div>
</div>

@include('partak.layout.menu')
@yield('content')

@stop

