@extends('partak.trips.layout')
@section('inner-content')

    <div class="row-grey">
        <div class="container">
            <div class="row-inner">
                <div class="col-sm-12">

                        <h3>My trips</h3>
                        @if(\App\Models\Buddy::with('trips')->find(Auth::id())->trips->count() > 0)
                            <div class="panel panel-default" id="protected">
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    @foreach(\App\Models\Buddy::with('trips')->find(Auth::id())->trips as $trip)
                                        <tr>
                                            <td>{{ $trip->event->name }}</td>
                                            <td>{{ $trip->event->datetime_from->toFormattedDateString() }}</td>
                                            <td>{{ $trip->trip_date_to->toFormattedDateString() }}</td>
                                            <td>{{ $trip->price }}@if(isset($trip->price)) Kč@endif</td>
                                            <td align="right">
                                                <a href="{{ url('partak/trips/detail/' . $trip->id_trip) }}" role="button" class="btn btn-info btn-xs">Detail</a>
                                                @can('acl', 'trips.edit')
                                                    <a href="{{ url('partak/trips/edit/' . $trip->id_trip) }}" role="button" class="btn btn-success btn-xs">Edit</a>
                                                @endcan
                                                @can('acl', 'trips.remove')
                                                    <protectedbutton  url="{{ url('partak/trips/delete/'. $trip->id_trip) }}"
                                                                      protection-text="Delete {{ $trip->name }} trip?"
                                                                      button-style="btn-danger btn-xs"><span class="glyphicon glyphicon-remove up"></span> Delete</protectedbutton></td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            @else No trips
                            <div style="min-height: 100px"></div>
                        @endif
                </div>
            </div>
        </div>
    </div>
@stop