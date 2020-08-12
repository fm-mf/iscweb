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
                <div class="form-group row">
                    <div class="col-sm-6">
                        {{ Form::bsText('phone', __('buddy-program.phone'), '', $buddy->phone) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsSelect('id_faculty', __('buddy-program.faculty'), $faculties, $buddy->id_faculty) }}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        {{ Form::bsSelect('sex', __('buddy-program.my-profile.sex'), ['M' => __('buddy-program.my-profile.sex-m'), 'F' => __('buddy-program.my-profile.sex-f')], $buddy->person->sex, ['class' => 'form-control'])}}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::bsNumber('age', __('buddy-program.my-profile.year-of-birth'), '', $buddy->person->age) }}
                    </div>
                    <div class="col-sm-6 info"></div>
                </div>

                {{ Form::bsTextarea('about', __('buddy-program.my-profile.about-you'), '', $buddy->about) }}

                <div class="checkbox">
                    @if ($errors->has('subscribed'))
                        <p class="error-block alert-danger">{{ $errors->first('subscribed') }}</p>
                    @endif
                    <label class="col-sm-12">
                        <input type="checkbox" name="subscribed" value="1"{{ $buddy->subscribed === 1 ? ' checked="checked"' :'' }} /> @lang('buddy-program.my-profile.subscribed')
                    </label>
                </div>

                <div class="mt-2">
                    {{ Form::bsSubmit(__('buddy-program.my-profile.save-profile'), 'check') }}
                </div>
            </fieldset>
            {{ Form::close() }}

            {{ Form::open(['route' => 'buddy-password-change', 'method' => 'post']) }}
            <fieldset>
                <legend>@lang('buddy-program.my-profile.change-password')</legend>

                <div class="form-group row mb-0">
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
