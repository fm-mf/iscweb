@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        <div class="row-inner buddy-detail">
            <h2 >Payment detail for trip {{ $trip->event->name }}</h2>
            <img class="img-circle pull-left buddy-detail-img"  width="100" src="{{ asset($part->person->avatar()) }}">
            <h3>{{ $part->person->getFullName()}}</h3>
            <span class="glyphicon glyphicon-envelope up buddy-detail-icon"></span> {{ $part->person->user->email }} <br>
            <span class="glyphicon glyphicon-phone-alt buddy-detail-icon"></span> @if(isset($part->phone)) {{ $part->phone }} @else No Phone @endif<br>
        </div>
    </div>
    <div class="container">
        <div class="row row-inner" id="form">
            <div class="col-md-7">
                {{ Form::open() }}
                {{ Form::bsText('paid', 'Paid','', $part->pivot->paid, ['readonly' => '']) }}

                <div class="form-group row">
                    <div class="col-sm-5 left">
                        {{ Form::bsText('registered_by', 'Register by', '', $registerby->person->getFullName(), ['readonly' => '']) }}
                    </div>
                    <div class="col-sm-5 left">
                        {{ Form::bsText('created_at', 'Register at', '', $part->pivot->created_at, ['readonly' => '']) }}
                    </div>
                    <div class="col-sm-2 left">
                        <div>
                            <label></label>
                        </div>
                        <a href="{{ $registerby->getDetailLink() }}" role="button" class="btn btn-info btn-xs">Detail</a>
                    </div>
                </div>

                {{ Form::bsTextarea('comment', 'Comment', '', $part->pivot->comment, ['readonly' => '']) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop