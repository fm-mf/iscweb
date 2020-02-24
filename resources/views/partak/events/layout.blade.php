@extends('partak.layout.subpage')

@section('subpage')
    @include('partak.components.subnav', [
        'navItems' => [
            ['title' => 'Active events', 'route' => 'partak.events'],
            ['title' => 'Add event', 'route' => 'partak.events.create', 'acl' => 'events.add'],
            ['title' => 'Add trip', 'route' => 'partak.trips.create', 'acl' => 'trips.add']
        ]
    ])

    <div class="inner-content" id="protected">
        @yield('inner-content')
    </div>
@stop