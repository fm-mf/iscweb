@extends('partak.users.layout')
@section('inner-content')
    <div class="container">
        <h2 class="mb-4">Payment detail for trip {{ $trip->event->name }}</h2>
        @include("partak.users.partials.user-info", ['user' => $part->user, 'noTitle' => true])
    </div>
    <div class="container" id="form">
        <div class="col-xl-7">
            {{ Form::open() }}
            {{ Form::bsText('paid', 'Paid','', $part->pivot->paid, ['readonly' => '']) }}

            @include('partak.trips.custom-questions', ['id_user' => $part->id_user, 'readonly' => true])

            <div class="form-group row">
                <div class="col-sm-6 left">
                    <div class="form-group">
                        <label>Registered by</label>
                        <div class="form-control">
                            @include('partak.components.user-link', ['user' => $registerby->person])
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 left">
                    {{ Form::bsText('created_at', 'Registered at', '', $part->pivot->created_at, ['readonly' => '']) }}
                </div>
            </div>

            {{ Form::bsTextarea('comment', 'Comment', '', $part->pivot->comment, ['readonly' => '']) }}

            {{ Form::bsText('payment_method', 'Payment method', null, $receipt->payment_method->name ?? 'N/A', ['readonly' => '']) }}

            {{ Form::close() }}
        </div>
    </div>
@stop
