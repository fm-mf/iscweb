@extends('partak.trips.layout')
@section('inner-content')
    @if(session('tripDeleted'))
        <div class="success">
            <i class="fas fa-check mr-1"></i> {{ session('tripDeleted') }}
        </div>
    @endif

    <div class="container">
        <h3>Active trips</h3>
        @if($visibleTrips->count() > 0)
            <div class="panel panel-default">
                @include('partak.trips.tripsTable', ['Trips' => $visibleTrips])
            </div>
        @endif
    </div>

    <div class="container">
        <a data-toggle="collapse" href="#collapseT1"><h3>Old Trips</h3></a>
        @if($oldTrips->count() > 0)
            <div class="panel panel-collapse collapse" id="collapseT1">
                @include('partak.trips.tripsTable', ['Trips' => $oldTrips,])
            </div>
        @endif
    </div>
@stop
