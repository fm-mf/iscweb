@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {{ session('removeSuccess') }}
        </div>
    @endif

    <div class="container">
        <h2 class="mb-4">&quot;{{ $trip->event->name }}&quot; participant detail</h2>
        @include("partak.users.partials.user-info", ['user' => $part->user, 'noTitle' => true])
    </div>


    <div class="container" id="form">
        <div class="col-xl-7">
            {{ Form::model($part, ['url' => '/partak/trips/detail/'. $trip->id_trip .'/add/'. $part->id_user, 'method' => 'patch', 'id' => 'roles']) }}

            @if ($trip->event->reservations_medical)
                {{ Form::bsText('medical_issues', 'Medical Issues','', $part->medical_issues) }}
            @endif

            @if($trip->event->reservations_diet)
                {{ Form::bsSelect('diet', 'Diet', $diets, $part->diet, ['placeholder' => 'No diet'])  }}
            @endif

            @include('partak.trips.custom-questions', ['id_user' => $part->id_user, 'readonly' => $reservation])

            <div class="form-group">
                {{ Form::label('paid', 'Paid', ['class' => 'required']) }}
                {{ Form::number('paid', $trip->price, ['class' => 'form-control', 'required' => 'required']) }}
            </div>

            <x-input-payment-methods />

            {{ Form::bsTextarea('comment', 'Comment') }}

            {{ Form::bsSubmit('Add Participant') }}

            {{ Form::close() }}
        </div>
    </div>
@stop
