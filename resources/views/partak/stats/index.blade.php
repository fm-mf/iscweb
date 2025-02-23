@extends('partak.layout.main')
@section('page')
    <div id="stats-app">
        <partak-stats current-semester="{{ $semester }}"></partak-stats>
    </div>
@stop

@section('scripts')
    @parent
    <script src="{{ mix('js/partak-stats.js') }}"></script>
@stop
