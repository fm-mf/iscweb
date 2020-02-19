@extends('partak.layout.subpage')

@section('subpage')
    @include('partak.components.subnav', [
        'navItems' => [
            ['title' => 'My trips', 'route' => 'partak.trips.my'],
            ['title' => 'Active trips', 'route' => 'partak.trips', 'acl' => 'trips.view'],
            ['title' => 'Add trip', 'route' => 'partak.trips.create', 'acl' => 'trips.add']
        ]
    ])

    <div class="inner-content" id="protected">
        @yield('inner-content')
    </div>
@stop
