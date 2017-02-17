@extends('partak.layout.subpage')

@section('content')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu matched-cols">
                <ul class="list-unstyled">
                    <li @if(Request::is('/partak/trips/mytrips') || Request::is('/partak/trips/mytrips/*')) class="sub-active" @endif>
                        <a href="{{ url('partak/trips/mytrips') }}">My Trips</a>
                    </li>
                    @can('acl', 'trips.view')
                    <li @if(Request::is('/partak/trips') || Request::is('/partak/trips/*')) class="sub-active" @endif>
                        <a href="{{ url('partak/trips') }}">Active trips</a>
                    </li>
                    @endcan
                    @can('acl', 'trips.add')
                    <li @if(Request::is('/partak/trips/create') || Request::is('/partak/trips/create/*')) class="sub-active" @endif>
                        <a href="{{ url('partak/trips/create') }}">Add Trip</a>
                    </li>
                    @endcan
                </ul>
            </div>
            <div class="col-sm-9 no-padding matched-cols">
                <div class="inner-content" id="protected">
                    @yield('inner-content')
                </div>
            </div>
        </div>
    </div>
@stop