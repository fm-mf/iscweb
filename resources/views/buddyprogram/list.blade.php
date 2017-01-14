@extends('layouts.buddyprogram.layout')

@section('content')
<div id="app">
    <myvue></myvue>
</div>


@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('/js/app.js') }}"></script>
@stop