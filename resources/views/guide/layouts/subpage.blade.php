@extends('web.layouts.subpage')
@section('wrapper-class', 'guide-wrapper subpage-wrapper')
@section('navClass', 'navbar-dark')
@section('title', 'Survival Guide')

@section('content')
  <div class="guide-content guide-subpage">
    <div class="hidden-sm hidden-xs">
      @include('guide.layouts.navigation')
    </div>
    <div class="guide-subpage-content">
      @yield('subpage')
    </div>
  </div>
@stop