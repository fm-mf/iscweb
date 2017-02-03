@extends('partak.layout.main')
@section('page')
    <div class="subpage-header-wrapper">
        <h1 class="title">Believe in ISC Spirit. Pass it on. <br>
            <small>ParťákNET je informačním centrem ISC</small></h1>
    </div>

    @include('partak.layout.menu')

    @yield('content')

@stop

