@extends('partak.layout.subpage')

@section('content')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu matched-cols">
                <ul class="list-unstyled">
                    <li>Trips registrations</li>
                    <li @if(Request::is('/partak/trips') || Request::is('/partak/trips/*')) class="sub-active" @endif>
                        <a href="{{ url('partak/trips') }}">Buddies</a>
                    </li>
                    <li @if(Request::is('/partak/trips/add') || Request::is('/partak/trips/add/*')) class="sub-active" @endif>
                        <a href="{{ url('partak/trips/add') }}">Add Trip</a>
                    </li>
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