@extends('web.layouts.layout')

@section('page')
    <div class="activities-wrapper">
        @include('web.layouts.navigation')
    </div>

<div class="container menu">
    <ul class="row list-unstyled">
        <li class="col-sm-3"><a href="{{ url('/activities/language-programs') }}" class="link"><img src="{{ URL::asset('img/web/languages.jpg') }}"><span class="menu-title"></span><span class="menu-arrow"></span><strong id="here">LANGUAGE PROGRAMS</strong></a></li>
        <li class="col-sm-3"><a href="{{ url('/activities/sports') }}" class="link"><img src="{{ URL::asset('img/web/sports.jpg') }}"><span class="menu-title"></span><span class="menu-arrow"></span><strong>SPORTS</strong></a></li>
        <li class="col-sm-3"><a href="{{ url('/activities/integreat') }}" class="link"><img src="{{ URL::asset('img/web/presentations.jpg') }}"><span class="menu-title"></span><span class="menu-arrow"></span><strong>inteGREAT</strong></a></li>
        <li class="col-sm-3"><a href="{{ url('/activities/trips') }}" class="link"><img src="{{ URL::asset('img/web/trips.jpg') }}"><span class="menu-title"></span><span class="menu-arrow"></span>
        <span id="content"></span><strong>TRIPS</strong></a></li>
    </ul>
</div>
<span class="show-menu"></span>
@yield('content')
@endsection