@extends('auth.layouts.layout')

@section('title', __('auth.registration'))

@section('page')
    <h1>
        @lang('auth.registration-heading')
    </h1>
    <div class="alert alert-danger mb-5" lang="en" role="alert">
        <h4 class="alert-heading">
            Warning!
        </h4>
        <p>
            <strong>This registration is only for local students who want to become a Buddy!</strong>
        </p>
        <p>
            If you are an exchange student, please, <strong>do not register here</strong>.
            We will contact you through e-mail approximately 2–3 months before the start of the semester
            with more information about how to get a Buddy.
        </p>
        <p class="mb-0">
            If you are a <strong>new degree student who wants to get a Buddy</strong>, please, continue to
            <a href="{{ route('register.degree-student') }}" class="alert-link">separate registration form</a>.
        </p>
    </div>

    @lang('auth.registration-info', ['href' => route('buddy-home')])

{{--
    @component('components.btn-auth-ctu')
    @endcomponent
    <p>
        <em>
            @lang('auth.register-with-ctu.notice', [
                'btnTitle' => __('auth.register-with-ctu.btn-title'),
                'hrefCode' => '#buddy-code-of-conduct',
                'hrefPrivacy' => route('privacy.agreement-cs')
            ])
        </em>
    </p>
--}}

    {{ Form::open(['route' => (($degreeBuddy ?? false) ? 'register.degree-buddy' : 'register'), 'class' => 'mt-4']) }}
        @include('auth.partials.user')

        <fieldset id="buddy-code-of-conduct">
            <legend>@lang('auth.code-of-conduct.title')</legend>

            @lang('auth.code-of-conduct.text')

            <div class="form-group form-check">
                @php
                    $isInvalid = $errors->has('code_of_conduct') ? ' is-invalid' : '';
                @endphp
                {{ Form::checkbox('code_of_conduct', 1, null, ['class' => 'form-check-input' . $isInvalid, 'required' => 'required', 'id' => 'code_of_conduct']) }}
                {{ Form::label('code_of_conduct', __('auth.code-of-conduct.approval'), ['class' => 'form-check-label required']) }}
                @error('code_of_conduct')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>
        <div class="form-group form-check">
            @php
                $isInvalid = $errors->has('agreement') ? ' is-invalid' : '';
            @endphp
            {{ Form::checkbox('agreement', 1, null, ['class' => 'form-check-input' . $isInvalid, 'required' => 'required', 'id' => 'agreement']) }}
            {{ Form::label('agreement', __('auth.privacy-approval', ['href' => route('privacy.agreement-cs')]), ['class' => 'form-check-label required'], false) }}
            @error('agreement')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if($degreeBuddy ?? false)
            {{ Form::hidden('degree_buddy', true) }}
        @endif
        <div class="form-group">
            {{ Form::button(__('auth.register'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
@endsection
