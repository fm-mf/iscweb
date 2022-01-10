@extends('auth.layouts.layout')

@section('title', __('auth.login'))

@section('page')
    @component('components.alert-success', ['sessionKey' => 'status']) @endcomponent

    <blockquote class="blockquote" lang="en">
        <p class="mb-0">‘We can’t help everyone, but everyone can help someone.’</p>
        <footer class="blockquote-footer">Ronald Reagan</footer>
    </blockquote>
    @if(Str::startsWith(session()->get('url.intended'), route('partak.index')))
        <h1>@lang('auth.login-heading-partak')</h1>
    @else
        <h1>@lang('auth.login-heading-buddy')</h1>
    @endif

{{--
    @component('components.btn-auth-ctu')
    @endcomponent
--}}

    {{ Form::open(['route' => 'login']) }}
        <div class="form-group">
            @php
                $isInvalid = $errors->has('email') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('email', __('auth.e-mail'), ['class' => 'required']) }}
            {{ Form::email('email', null, ['required' => 'required', 'class' => 'form-control' . $isInvalid, 'placeholder' => __('auth.placeholder.e-mail'), 'autofocus' => 'autofocus', 'autocomplete' => 'username']) }}
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            {{ Form::label('password', __('auth.password'), ['class' => 'required']) }}
            {{ Form::password('password', ['required' => 'required', 'class' => 'form-control', 'placeholder' => __('auth.placeholder.password'), 'autocomplete' => 'current-password']) }}
        </div>
        <div class="form-group">
            {{ Form::button(__('auth.log-in'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}

    <p>
        @lang('auth.no-account-yet')
        <a class="font-weight-bold" href="{{ route('register') }}">@lang('auth.register-imp')</a>
    </p>
    <p>
        <a class="font-weight-bold" href="{{ route('auth.password-reset-form') }}">@lang('auth.forgot-your-password')</a>
    </p>
@endsection
