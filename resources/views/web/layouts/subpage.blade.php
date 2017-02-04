@extends('web.layouts.layout')
@section('page')
<div class="@yield('wrapper-class')">
    @include('web.layouts.navigation')
    <h1 class="title"><strong>@yield('title')</strong></h1>
    <span class="show-menu"></span>
</div>
@yield('content')
@endsection