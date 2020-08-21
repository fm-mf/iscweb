@extends('layouts.buddyprogram.layout')
@section('content')
    <div class="container page">
        <div class="my-profile">
            <h1 class="text-center">@lang('buddy-program.my-profile.title')</h1>

            @if(session('success'))
            <div class="alert-success p-3 mb-4">
                <i class="fas fa-check mr-2"></i> {{ session('success') }}
            </div>
            @endif

            {{ Form::model($buddy, ['route' => 'buddy-update-my-profile', 'method' => 'patch']) }}
            <fieldset class="mb-4">
                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsText('first_name', __('buddy-program.my-profile.given-names'), '', $buddy->person->first_name, ['disabled' => 'disabled']) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsText('last_name', __('buddy-program.my-profile.surname'), '', $buddy->person->last_name, ['disabled' => 'disabled']) }}
                    </div>
                </div>

                {{ Form::bsEmail('email', __('buddy-program.e-mail'), '', $buddy->email, ['disabled' => 'disabled']) }}

                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsText('phone', __('buddy-program.phone'), '', $buddy->phone) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsSelect('id_faculty', __('buddy-program.faculty'), $faculties, $buddy->id_faculty) }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        {{ Form::bsSelect(
                            'sex', __('buddy-program.my-profile.sex'),
                            [
                                'M' => __('buddy-program.sex-m'),
                                'F' => __('buddy-program.sex-f'),
                            ],
                            $buddy->person->sex,
                            [
                                'class' => 'form-control',
                            ]
                        ) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsNumber(
                            'age',
                            __('buddy-program.my-profile.year-of-birth'),
                            '',
                            $buddy->person->age,
                            [
                                'min' => 1901,
                                'max' => 2155,
                            ]
                        ) }}
                    </div>
                    <div class="col-sm-6 info"></div>
                </div>

                {{ Form::bsTextarea('about', __('buddy-program.my-profile.about-you'), '', $buddy->about) }}

                {{ Form::bsSelect(
                    'preferred_language',
                    __('buddy-program.my-profile.preferred-language'),
                    $availableLanguages,
                    $buddy->preferred_language,
                    [],
                    __('buddy-program.my-profile.note-language')
                ) }}

                <div class="form-group">
                    @if ($errors->has('subscribed'))
                        <p class="error-block alert-danger">{{ $errors->first('subscribed') }}</p>
                    @endif
                    <div class="form-check">
                        {{ Form::checkbox('subscribed', 1, $buddy->subscribed === 1, ['class' => 'form-check-input', 'id' => 'subscribed']) }}
                        {{ Form::label('subscribed', __('buddy-program.my-profile.subscribed'), ['class' => 'form-check-label']) }}
                    </div>
                </div>

                <div class="mt-2">
                    {{ Form::bsSubmit(__('buddy-program.my-profile.save-profile'), 'check') }}
                </div>
            </fieldset>
            {{ Form::close() }}

            {{ Form::open(['route' => 'buddy-password-change', 'method' => 'post']) }}
            <fieldset>
                <legend>@lang('buddy-program.my-profile.change-password')</legend>

                <div class="row">
                    <div class="col-sm-4">
                        {{ Form::bsPassword('old_password', __('buddy-program.my-profile.old-password')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsPassword('new_password', __('buddy-program.my-profile.new-password')) }}
                    </div>
                    <div class="col-sm-4">
                        {{ Form::bsPassword('new_password_confirmation', __('buddy-program.my-profile.new-password-again')) }}
                    </div>
                </div>

                {{ Form::bsSubmit(__('buddy-program.my-profile.change-password'), 'key') }}
            </fieldset>

            {{ Form::close() }}

        </div>
    </div>
@stop
