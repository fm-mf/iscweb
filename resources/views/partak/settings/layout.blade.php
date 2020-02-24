@extends('partak.layout.subpage')

@section('subpage')
    @include('partak.components.subnav', [
        'navItems' => [
            ['title' => 'General', 'route' => 'partak.settings', 'acl' => 'settings.edit'],
            ['title' => 'Active trips', 'route' => 'partak.settings.contacts.index', 'acl' => 'settings.edit']
        ]
    ])

    <div class="inner-content" id="protected">
        @yield('inner-content')
    </div>
@stop
