@extends('layouts.web.layout')
@section('page')
<div class="@yield('wrapper-class')">
    @include('layouts.web.navigation')
    <h1 class="title"><strong>@yield('title')</strong></h1>
    <span class="show-menu"></span>
</div>
@yield('content')
@endsection