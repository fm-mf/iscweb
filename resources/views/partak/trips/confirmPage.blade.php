@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('removeSuccess') }}
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row-inner buddy-detail">
            <h2 >Participant detail</h2>
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($part->person->avatar()) }}">
            <h3>{{ $part->person->first_name .' '. $part->person->last_name}}</h3>
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $part->person->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> @if(isset($part->phone)) {{ $part->phone }} @else No Phone @endif<br>
        </div>
    </div>
    <div class="container">
        <div class="row row-inner" id="form">
            <div class="col-md-7">
                {{ Form::model($part, ['url' => '/partak/trips/detail/'. $trip->id_trip .'/add/'. $part->id_user, 'method' => 'patch', 'id' => 'roles']) }}
                {{ Form::bsText('medical_issues', 'Medical Issues','', $part->person->medical_issues) }}

                {{ Form::bsSelect('diet', 'Diet', $diets, $part->person->diet, ['placeholder' => 'No diet'])  }}

                {{ Form::label('paid', 'Paid', ['class' => 'control-label required']) }}
                {{ Form::number('paid', $trip->price, ['class' => 'form-control']) }}

                {{ Form::bsTextarea('comment', 'Comment') }}

                {{ Form::bsSubmit('Add Participant') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop