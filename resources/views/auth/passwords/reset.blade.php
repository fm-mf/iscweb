@extends('auth.layouts.layout')

@section('title', __('auth.passwords.title'))

@section('page')
    <h1>@lang('auth.passwords.title')</h1>

    {{ Form::open(['route' => 'password.update']) }}

        {{ Form::hidden('token', $token) }}

        <div class="form-group">
            @php
                $isInvalid = $errors->has('email') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('email', __('auth.e-mail'), ['class' => 'required']) }}
            {{ Form::email('email', $email ?? null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'placeholder' => __('auth.placeholder.e-mail'), 'autofocus' => 'autofocus', 'autocomplete' => 'username']) }}
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            @php
                $isInvalid = $errors->has('password') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('password', __('auth.password'), ['class' => 'required']) }}
            {{ Form::password('password', ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'min' => 8, 'placeholder' => __('auth.placeholder.password'), 'autocomplete' => 'new-password']) }}
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">@lang('auth.password-note')</small>
        </div>


        <div class="form-group">
            {{ Form::label('password_confirmation', __('auth.password-confirmation'), ['class' => 'required']) }}
            {{ Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required', 'min' => 8, 'placeholder' => __('auth.placeholder.password-confirmation'), 'autocomplete' => 'new-password']) }}
        </div>

        <div class="form-group">
            {{ Form::button(__('auth.passwords.reset'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    </form>
@endsection
