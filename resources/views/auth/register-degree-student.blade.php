@extends('auth.layouts.layout')

@section('title', __('auth.registration'))

@section('page')
    <h1>
        @lang('auth.registration-heading') – @lang('auth.register-check.degree')
    </h1>

    @lang('auth.degree-student.registration-info', ['href' => route('buddy-home')])

    {{ Form::open(['route' => 'register.degree-student', 'class' => 'mt-4']) }}
        @include('auth.partials.user')

        <div class="form-group">
            @php
                $isInvalid = $errors->has('id_country') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('id_country', __('auth.profile.country'), ['class' => 'required']) }}
            {{ Form::select('id_country', $countries, null, ['class' => "form-control$isInvalid", 'required' => 'required', 'placeholder' => __('auth.profile.placeholder.country')]) }}
            @error('id_country')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            @php
                $isInvalid = $errors->has('id_faculty') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('id_faculty', __('auth.profile.faculty'), ['class' => 'required']) }}
            {{ Form::select('id_faculty', $faculties, null, ['class' => "form-control$isInvalid", 'required' => 'required', 'placeholder' => __('auth.profile.placeholder.faculty')]) }}
            @error('id_faculty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group form-check">
            @php
                $isInvalid = $errors->has('agreement') ? ' is-invalid' : '';
            @endphp
            {{ Form::checkbox('agreement', 1, null, ['class' => 'form-check-input' . $isInvalid, 'required' => 'required', 'id' => 'agreement']) }}
            {{ Form::label('agreement', __('auth.privacy-approval', ['href' => route('privacy.policy')]), ['class' => 'form-check-label required'], false) }}
            @error('agreement')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::button(__('auth.register'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
@endsection
