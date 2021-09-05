@extends('auth.layouts.layout')

@section('title', __('auth.passwords.title'))

@section('page')
    @component('components.alert-success', ['sessionKey' => 'status']) @endcomponent

    <h1>@lang('auth.passwords.title')</h1>

    {{ Form::open(['route' => 'password.email']) }}

        <div class="form-group">
            @php
                $isInvalid = $errors->has('email') ? ' is-invalid' : '';
            @endphp
            {{ Form::label('email', __('auth.e-mail'), ['class' => 'required']) }}
            {{ Form::email('email', null, ['class' => 'form-control' . $isInvalid, 'required' => 'required', 'placeholder' => __('auth.placeholder.e-mail'), 'autofocus' => 'autofocus', 'autocomplete' => 'username']) }}
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            {{ Form::button(__('auth.passwords.send-link'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    </form>
@endsection
