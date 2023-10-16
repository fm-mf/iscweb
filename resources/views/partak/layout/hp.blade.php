@extends('partak.layout.main')

@php
    $photoPaths = [
        'img/partak/team_photo-0',
    ];
    $photoPath = $photoPaths[0];
@endphp

@section('page')
    <div class="dashboard-header">
        <picture>
            <source type="image/webp" srcset="{{ asset("$photoPath.webp") }}" />
            <img src="{{ asset("$photoPath.jpg") }}" alt="Team photo" />
        </picture>
    </div>

    @yield('subpage')
@stop
