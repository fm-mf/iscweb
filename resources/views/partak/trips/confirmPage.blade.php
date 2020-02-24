@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <i class="fas fa-check mr-1"></i> {{ session('removeSuccess') }}
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row-inner buddy-detail">
            <h2>&quot;{{ $trip->event->name }}&quot; participant detail</h2>
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($part->avatar()) }}">
            <h3>{{ $part->getFullName()}}</h3>
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $part->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> {{ $part->exchangeStudent->phone ?? $part->buddy->phone ?? 'No Phone' }}<br>
        </div>
    </div>
    <div class="container">
        <div class="row row-inner" id="form">
            <div class="col-md-7">
                {{ Form::model($part, ['url' => '/partak/trips/detail/'. $trip->id_trip .'/add/'. $part->id_user, 'method' => 'patch', 'id' => 'roles']) }}

                @if ($trip->event->reservations_medical)
                    {{ Form::bsText('medical_issues', 'Medical Issues','', $part->medical_issues) }}
                @endif

                @if($trip->event->reservations_diet)
                    {{ Form::bsSelect('diet', 'Diet', $diets, $part->diet, ['placeholder' => 'No diet'])  }}
                @endif

                @include('partak.trips.custom-questions', ['id_user' => $part->id_user, 'readonly' => $reservation])

                {{ Form::label('paid', 'Paid', ['class' => 'control-label required']) }}
                {{ Form::number('paid', $trip->price, ['class' => 'form-control']) }}

                {{ Form::bsTextarea('comment', 'Comment') }}

                {{ Form::bsSubmit('Add Participant') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
