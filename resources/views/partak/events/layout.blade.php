@extends('partak.layout.subpage')

@section('subpage')
    <div class="container-fluid">
        <div class="row match-my-cols">
            <div class="col-sm-3 submenu matched-cols">
                <ul class="list-unstyled">
                    <li @if(Request::is('/partak/events')) class="sub-active" @endif>
                        <a href="{{ url('partak/events') }}">Active events</a>
                    </li>
                    @can('acl', 'events.add')
                        <li @if(Request::is('/partak/events/create') || Request::is('/partak/events/create/*')) class="sub-active" @endif>
                            <a href="{{ url('partak/events/create') }}">Add Event</a>
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