@extends('web.layouts.layout')

@section('header')
    <div class="header-wrapper guide-wrapper subpage-wrapper">
        <header>
            @include('web.layouts.navigation')
            <h1>Survival Guide</h1>
        </header>
    </div>
@endsection

@section('page')
  <div class="guide-content guide-subpage">
    @include('guide.layouts.navigation')
    <div class="guide-subpage-content">
      @yield('subpage')
    </div>
  </div>
@stop

@section('title')
  @yield('subtitle') | Survival Guide
@endsection