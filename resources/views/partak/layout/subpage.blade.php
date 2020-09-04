@extends('partak.layout.main')
@section('page')

<div id="partakApp">
    @yield('subpage')
</div>

@stop
@section('scripts')
    @parent
    <script src="{{ mix('js/partak.js') }}" defer="defer"></script>
@stop
