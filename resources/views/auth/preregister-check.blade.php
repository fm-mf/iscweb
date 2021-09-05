@extends('auth.layouts.layout')

@section('title', __('auth.registration'))

@section('page')
    <h1>
        @lang('auth.registration-heading')
    </h1>

    {{ Form::open(['route' => 'register-check', 'class' => 'mt-4']) }}
        <div class="form-group">
            {{ Form::label(null, __('auth.register-check.label'), ['class' => 'mb-0 required']) }}
        </div>
        @php
            $isInvalid = $errors->has('registration_type') ? ' is-invalid' : '';
        @endphp
        @foreach($registrationTypes as $registrationType)
            <div class="form-group form-check">
                {{ Form::radio('registration_type', $registrationType, null, ['class' => 'form-check-input' . $isInvalid, 'required' => 'required', 'id' => "registration_type_$registrationType"]) }}
                {{ Form::label("registration_type_$registrationType", __("auth.register-check.label-$registrationType"), ['class' => 'form-check-label'], false) }}
            </div>
        @endforeach
        @error('registration_type')
            <div class="form-group form-check">
                <div class="invalid-feedback d-block">{{ $message }}</div>
            </div>
        @enderror
        <div class="form-group">
            {{ Form::button(__('auth.register-check.continue'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
@endsection
