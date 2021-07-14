@extends('partak.events.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i>{{ session('successUpdate') }}
        </div>
    @endif


    <div class="container" id="form">
        <div class="col-xl-8">
            <h2>Edit event</h2>
            {{ Form::model($event, ['route' => ['partak.events.update', $event], 'method' => 'patch', 'id' => 'form', 'files' => true]) }}

            @include('partak.trips.editForm',['trips' => false])

            {{ Form::bsSubmit('Update event') }}

            {{ Form::close() }}
        </div>
    </div>
@stop
