@extends('auth.layouts.layout')

@section('title', __('auth.profile.title'))

@section('page')
    @component('components.alert-success', ['sessionKey' => 'success'])
    @endcomponent

    <h1>@lang('auth.profile.title')</h1>

    @lang('auth.profile.info')

    <fieldset class="row" disabled="disabled">
        <legend class="col-12">@lang('auth.profile.basic-information')</legend>
        <div class="form-group col-sm-6">
            <label for="input_given_names">@lang('auth.profile.given-names')</label>
            <input type="text" id="input_given_names" class="form-control" value="{{ $buddy->person->first_name }}" />
        </div>
        <div class="form-group col-sm-6">
            <label for="input_surname">@lang('auth.profile.surname')</label>
            <input type="text" id="input_surname" class="form-control" value="{{ $buddy->person->last_name }}" />
        </div>
        <div class="form-group col-12">
            <label for="input_email">@lang('auth.e-mail')</label>
            <input type="email" id="input_email" class="form-control" value="{{ $buddy->user->email }}" />
            <small class="form-text text-muted">
                @lang('auth.profile.email-info')
                <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a>.
            </small>
        </div>
    </fieldset>

    <fieldset>
        <legend>🖼️ @lang('forms.profile-picture')</legend>
        @include('profile.avatar_bs4', [
            'avatar' => $buddy->person->avatar_url,
        ])
    </fieldset>

    {{ Form::model($buddy, ['route' => 'auth.profile.update', 'method' => 'patch', 'id' => 'profile-form']) }}
        <fieldset>
            <legend>💭 @lang('auth.profile.additional-information')</legend>

            <div class="row">
                <div class="form-group col-sm-6">
                    @php
                        $isInvalid = $errors->has('sex') ? ' is-invalid' : '';
                    @endphp
                    {{ Form::label('sex', __('auth.profile.sex')) }}
                    {{ Form::select('sex', $sexOptions, $buddy->person->sex, ['class' => 'form-control' . $isInvalid, 'placeholder' => __('auth.profile.placeholder.sex')]) }}
                    @error('sex')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-sm-6">
                    @php
                        $isInvalid = $errors->has('age') ? ' is-invalid' : '';
                    @endphp
                    {{ Form::label('age', __('auth.profile.year-of-birth')) }}
                    {{ Form::number('age', $buddy->person->age, ['class' => 'form-control', 'min' => 1901, 'max' => 2155, 'placeholder' => __('auth.profile.placeholder.year-of-birth')]) }}
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('id_faculty') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('id_faculty', __('auth.profile.faculty')) }}
                {{ Form::select('id_faculty', $faculties, null, ['class' => 'form-control' . $isInvalid, 'placeholder' => __('auth.profile.placeholder.faculty')]) }}
                @error('id_faculty')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('id_country') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('id_country', __('auth.profile.country')) }}
                {{ Form::select('id_country', $countries, null, ['class' => 'form-control' . $isInvalid, 'placeholder' => __('auth.profile.placeholder.country')]) }}
                @error('id_country')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('phone') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('phone', __('auth.profile.phone')) }}
                {{ Form::tel('phone', null, ['class' => 'form-control' . $isInvalid, 'max:255', 'placeholder' => __('auth.profile.placeholder.phone')]) }}
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('about') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('about', __('auth.profile.about-me')) }}
                {{ Form::textarea('about', null, ['class' => 'form-control' . $isInvalid, 'max' => '16383', 'placeholder' => __('auth.profile.placeholder.about-me')]) }}
                @error('about')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>
        <fieldset>
            <legend>@lang('auth.profile.newsletter')</legend>

            <div class="form-group form-check">
                @php
                    $isInvalid = $errors->has('subscribed') ? ' is-invalid' : '';
                @endphp
                {{ Form::checkbox('subscribed', 1, null, ['class' => 'form-check-input', 'id' => 'subscribed']) }}
                {{ Form::label('subscribed', __('auth.profile.newsletter-approval'),  ['class' => 'form-check-label' . $isInvalid]) }}
                @error('subscribed')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>
    {{ Form::close() }}

    <div class="row">
        <div class="form-group col-auto">
            {{ Form::button('<i class="fas fa-save"></i> ' . __('auth.profile.update'), ['type' => 'submit', 'class' => 'btn btn-primary', 'form' => 'profile-form']) }}
        </div>
        @if ($buddy->isNotVerified())
            <div class="form-group col-auto">
                {{ Form::open(['route' => 'auth.profile.skip', 'method' => 'post']) }}
                    {{ Form::button('<i class="fas fa-arrow-right"></i> ' . __('auth.profile.skip-to-verification'), ['type' => 'submit', 'class' => 'btn btn-outline-secondary']) }}
                {{ Form::close() }}
            </div>
        @endif
        @if(session()->has('social-auth'))
            <div class="form-group col-auto">
                <a href="{{ session('social-auth') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-right"></i>
                    @lang('auth.profile.skip-profile')
                </a>
            </div>
        @endif
    </div>
@endsection
