@extends('partak.trips.layout')
@section('inner-content')

    @if(session('success'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i>{{ session('success') }}
        </div>
    @endif


    <div class="container" id="form">
        <div class="col-xl-8">
            <h2>Edit trip <a href="{{ url('partak/trips/detail/' . $trip->id_trip) }}" role="button" class="btn btn-info btn-xs">Detail</a></h2>

            {{ Form::model($event, ['url' => 'partak/trips/edit/'. $trip->id_trip, 'method' => 'patch', 'id' => 'form', 'files' => true]) }}

            @include('partak.trips.editForm',['trips' => true])

            {{ Form::bsSubmit('Update event') }}

            {{ Form::close() }}
        </div>
    </div>
@stop
