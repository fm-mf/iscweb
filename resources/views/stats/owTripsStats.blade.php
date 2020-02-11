@extends('layouts.master')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ mix('css/web.css') }}" />
@endsection

@section('content')
    <div id="ow-trips-stats-app">
        <ow-trips-stats></ow-trips-stats>
    </div>
@stop

@section('scripts')
    <script src="{{ mix('js/ow-trips-stats.js') }}" defer="defer"></script>
@endsection
