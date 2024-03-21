@extends('auth.layouts.layout')

@section('title', __('privacy.partak.title'))

@section('page')
    <h1>
        @lang('privacy.partak.heading')
    </h1>
    @lang('privacy.partak.text')
    {{ Form::open(['route' => 'privacy.partak']) }}
    <div class="form-group">
        {{ Form::button(__('privacy.agree'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
@endsection
