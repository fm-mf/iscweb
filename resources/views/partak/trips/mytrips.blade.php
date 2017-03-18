@extends('partak.trips.layout')
@section('inner-content')

    <div class="row-grey">
        <div class="container">
            <div class="row-inner">
                <div class="col-sm-12">
                    <h3>My trips</h3>
                    @if($myTrips->count() > 0)
                        <div class="panel panel-default" id="protected">
                            @include('partak.trips.tripsTable', ['Trips' => $myTrips])
                        </div>
                        @else No trips
                        <div style="min-height: 100px"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop