@extends('partak.layout.main')
@section('page')

<div id="partakApp">
    @yield('content')
</div>

@stop
@section('scripts')
    @parent
    <script src="{{ mix('js/partak.js') }}"></script>
@stop
