@extends('partak.layout.main')
@section('page')
    <div class="dashboard-header">
        <img src="{{ asset('img/partak/team-photo.jpg') }}" alt="Team photo" />
    </div>

    @yield('subpage')
@stop

