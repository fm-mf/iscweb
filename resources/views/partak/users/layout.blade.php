@extends('partak.layout.subpage')

@section('subpage')
    @include('partak.components.subnav', [
        'navItems' => [
            ['title' => 'Buddies', 'route' => 'partak.users.buddies', 'acl' => 'buddy.view'],
            ['title' => 'Exchange students', 'route' => 'partak.users.exchangeStudents', 'acl' => 'exchangeStudents.view'],
            ['title' => 'Office registration', 'route' => 'partak.users.registration', 'acl' => 'exchangeStudents.register'],
            ['title' => 'Preregistrations', 'route' => 'partak.users.preregistrations', 'acl' => 'exchangeStudents.register'],
            ['title' => 'Roles', 'route' => 'partak.roles', 'acl' => 'roles.view'],
            ['title' => 'Parťáks', 'route' => 'partak.users.partaks', 'acl' => 'roles.view']
        ]
    ])

    <div class="inner-content" id="protected">
        @yield('inner-content')
    </div>
@stop