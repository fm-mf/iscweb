@extends('partak.trips.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> Profile was successfully updated.
        </div>
    @endif

    <div class="container" id="form">
        <div class="col-xl-8">
            <h2>Create trip</h2>
            {{ Form::model($event, ['url' => 'partak/trips/create', 'method' => 'patch', 'id' => 'form', 'files' => true]) }}
            @include('partak.trips.editForm',['trips' => true])

            {{ Form::bsSubmit('Create trip') }}

            {{ Form::close() }}
        </div>
    </div>
@stop

