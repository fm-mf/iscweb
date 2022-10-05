@extends('partak.layout.main')
@section('page')
    <div class="dashboard-header">
        <picture>
            <source type="image/webp" srcset="{{ asset('img/partak/team_photo.webp') }}" />
            <img src="{{ asset('img/partak/team_photo.jpg') }}" alt="Team photo" />
        </picture>
    </div>

    @yield('subpage')
@stop
