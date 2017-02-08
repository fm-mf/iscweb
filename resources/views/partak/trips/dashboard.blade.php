@extends('partak.trips.layout')
@section('inner-content')

    <div class="row row-grey">
        <div class="row-inner">
            <div class="col-sm-12">
                <h3>Active trips</h3>
                @if($visibleEvents->count() > 0)
                    <div class="panel panel-default" id="protected">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Price</th>
                                <th>Detail</th>
                            </tr>
                            @foreach($visibleEvents as $trip)
                                <tr>
                                    <td>{{ $trip->name }}</td>
                                    <td>{{ $trip->datetime_from->toFormattedDateString() }}</td>
                                    <td>{{ $trip->datetime_to->toFormattedDateString() }}</td>
                                    <td>{{ $trip->price }}@if(isset($trip->price)) Kč@endif</td>
                                    <td><a href="{{ url('partak/trips/detail/' . $trip->id_event) }}" role="button" class="btn btn-info btn-xs">Detail</a></td>
                                    @can('acl', 'trips.remove') <td><protectedbutton  url="{{ url('partak/trips/delete/'. $trip->id_event) }}"
                                                          protection-text="Delete {{ $trip->name }} trip?"
                                                          button-style="btn-danger"><span class="glyphicon glyphicon-remove up"></span> Delete</protectedbutton></td>
                                    @endcan
                                </tr>
                            @endforeach
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @stop