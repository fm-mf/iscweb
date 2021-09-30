@extends('web.layouts.layout')

@section('header')
    <div class="header-wrapper guide">
        <header>
            @include('web.layouts.navigation')
            <h1>Survival Guide</h1>
        </header>
    </div>
@endsection

@section('page')
    <div class="container text-left guide-subpage">
        @include('guide.layouts.navigation')
        <div class="guide-subpage-content">
            @yield('subpage')
        </div>
    </div>
@stop

@section('title')
    @yield('subtitle') – Survival Guide
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/guide.css') }}"/>
@endsection
