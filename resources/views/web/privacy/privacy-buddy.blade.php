@extends('auth.layouts.layout')

@section('title', __('privacy.buddy.title'))

@section('page')
    <h1>
        @lang('privacy.buddy.heading')
    </h1>
    @lang('privacy.buddy.text')
    {{ Form::open(['route' => 'privacy.buddy']) }}
        <div class="form-group">
            {{ Form::button(__('privacy.agree'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
@endsection
