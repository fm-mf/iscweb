@extends('partak.layout.main')
@section('page')
    <div class="subpage-header-wrapper">
        <div class="container">
            <div class="row">
                <div class="collapse navbar-collapse navbar-right navbar-main-collapse col-sm-9">
                    <ul class="nav navbar-nav login-nav">
                        <li><a href="{{ url('user/logout') }}"><img src="{{ URL::asset('img/partak/log-out.png') }}" />Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <h1 class="title-sp"><strong>PARŤÁKNET DASHBOARD</strong></h1>
    </div>

    @include('partak.layout.menu')

    @yield('content')

@stop

