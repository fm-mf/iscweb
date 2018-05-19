@extends('partak.trips.layout')
@section('inner-content')

    @if(session('tripDeleted'))
    <div class="row">
        <div class="row-inner">
            <div class="success">
                <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('tripDeleted') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row-grey">
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-12">
                    <h3>Active trips</h3>
                    @if($visibleTrips->count() > 0)
                        <div class="panel panel-default">
                            @include('partak.trips.tripsTable', ['Trips' => $visibleTrips])
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li id="t1"><a data-toggle="collapse" data-parent="t1" href="#collapseT1"><h3>Old Trips</h3></a>
                            @if($oldTrips->count() > 0)
                                <div class="panel panel-collapse collapse" id="collapseT1">
                                    @include('partak.trips.tripsTable', ['Trips' => $oldTrips,])
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @stop
