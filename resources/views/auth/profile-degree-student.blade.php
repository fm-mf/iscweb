@extends('auth.layouts.layout')

@section('title', __('auth.profile.title'))

@section('page')
    @component('components.alert-success', ['sessionKey' => 'success'])
    @endcomponent

    <h1>Buddy programme profile</h1>
    <p>
        After you fill in your profile, you'll be added to our Buddy programme database.
    </p>
    <p>
        You will receive an e-mail notification as soon as you get a Buddy.
        It is likely that your Buddy will attempt to contact you using the contact methods provided below.
    </p>

    <fieldset class="row" disabled="disabled">
        <legend class="col-12">Basic information</legend>
        <div class="form-group col-sm-6">
            <label for="input_given_names">Given names</label>
            <input type="text" id="input_given_names" class="form-control" value="{{ $student->person->first_name }}" />
        </div>
        <div class="form-group col-sm-6">
            <label for="input_surname">Surname</label>
            <input type="text" id="input_surname" class="form-control" value="{{ $student->person->last_name }}" />
        </div>
        <div class="form-group col-12">
            <label for="input_email">E-mail address</label>
            <input type="email" id="input_email" class="form-control" value="{{ $student->user->email }}" />
            <small class="form-text text-muted">
                This e-mail address will be used whenever we need to contact you.
                If you want to change it, contact us at <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a>.
            </small>
        </div>
        <div class="form-group col-12">
            <label for="input_country">Country</label>
            <input type="text" id="input_country" class="form-control" value="{{ $student->country->full_name }}" />
        </div>
        <div class="form-group col-12">
            <label for="input_country">Faculty</label>
            <input type="text" id="input_country" class="form-control" value="{{ $student->faculty->faculty }}" />
        </div>
    </fieldset>

    <fieldset>
        <legend>🖼️ @lang('forms.profile-picture')</legend>
        @include('profile.avatar_bs4', [
            'avatar' => $student->person->avatar_url,
        ])
    </fieldset>

    {{ Form::model($student, ['route' => 'auth.profile.update', 'method' => 'patch', 'id' => 'profile-form']) }}
        <fieldset class="row">
            <legend class="col-12">📝 Necessary information</legend>

            <div class="form-group col-sm-6">
                @php
                    $isInvalid = $errors->has('age') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('age', __('auth.profile.year-of-birth'), ['class' => 'required']) }}
                {{ Form::number('age', $student->person->age, ['class' => "form-control$isInvalid", 'required' => 'required', 'min' => 1901, 'max' => 2155, 'placeholder' => __('auth.profile.placeholder.year-of-birth')]) }}
                @error('age')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                @php
                    $isInvalid = $errors->has('sex') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('sex', __('auth.profile.sex'), ['class' => 'required']) }}
                {{ Form::select('sex', $sexOptions, $student->person->sex, ['class' => "form-control$isInvalid", 'required' => 'required', 'placeholder' => __('auth.profile.placeholder.sex')]) }}
                @error('sex')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>

        <fieldset>
            <legend>💭 About yourself</legend>

            <p>
                Tell your potential Buddy about your hobbies, interests, favourite movies or anything
                that you find important about yourself.
            </p>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('about') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('about', __('auth.profile.about-me'), ['class' => 'required']) }}
                {{ Form::textarea('about', null, ['class' => "form-control$isInvalid", 'required' => 'required', 'max' => '16383', 'placeholder' => 'Hobbies, interests, favourite movies...']) }}
                @error('about')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>

        <fieldset class="row">
            <legend class="col-12">✈️ Arrival information</legend>

            <p class="col-12">
                Arrival information is an important piece of information for our Buddies.
                If you don't know the information now, you can (and should) update the arrival information later.
            </p>

            <div class="form-group col-12">
                <input type="hidden" name="arrival_skipped" value="0" />
                <label>
                    <input type="checkbox" name="arrival_skipped" id="arrival_skipped" value="1">
                    I don't know when I'll arrive yet.
                </label>
            </div>

            <div class="form-group col-sm-6">
                @php
                    $isInvalid = $errors->has('arrival_date') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('arrival_date', 'Day of arrival') }}
                {{ Form::text('arrival_date', null, ['class' => "date form-control arrival$isInvalid"]) }}
                @error('arrival_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-sm-6">
                @php
                    $isInvalid = $errors->has('arrival_time') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('arrival_time', 'Time of arrival') }}
                {{ Form::text('arrival_time', null, ['class' => "time form-control arrival$isInvalid"]) }}
                @error('arrival_time')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group col-12">
                @php
                    $isInvalid = $errors->has('transportation') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('transportation', 'Means of transport') }}
                {{ Form::select('transportation', $transportations, null, ['class' => "form-control arrival$isInvalid", 'placeholder' => 'Select transportation...']) }}
                @error('transportation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>

        <fieldset>
            <legend>🏢 Accommodation</legend>
            <div class="form-group">
                @php
                    $isInvalid = $errors->has('accommodation') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('accommodation', 'Where are you going to stay?', ['class' => 'required']) }}
                {{ Form::select('accommodation', $accommodations, null, ['class' => "form-control$isInvalid", 'required' => 'required', 'placeholder' => 'Select accommodation...']) }}
                @error('accommodation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </fieldset>

        <fieldset>
            <legend>📇 Additional contacts</legend>

            <p>
                Your Buddy will receive your e-mail as a primary contact.
                If you want to provide more ways to contact you, you can enter them here.
            </p>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('facebook') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('facebook', 'Facebook') }}
                {{ Form::url('facebook', null, ['class' => "form-control$isInvalid"]) }}
                @error('facebook')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Full link to your Facebook profile</small>
            </div>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('instagram') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('instagram', 'Instagram') }}
                {{ Form::text('instagram', null, ['class' => "form-control$isInvalid"]) }}
                @error('instagram')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Your Instagram handle without @</small>
            </div>

            <div class="form-group">
                @php
                    $isInvalid = $errors->has('whatsapp') ? ' is-invalid' : '';
                @endphp
                {{ Form::label('whatsapp', 'WhatsApp') }}
                {{ Form::tel('whatsapp', null, ['class' => "form-control$isInvalid"]) }}
                @error('whatsapp')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Full number, including the country prefix</small>
            </div>
        </fieldset>

        <fieldset>
            <legend>Privacy policy</legend>
            <div class="form-group">
                <label class="required">
                    {{ Form::checkbox('privacy_policy', 1, false, ['required' => 'required']) }} I agree with the
                    <a href="{{ route('privacy.policy') }}" target="_blank" title="Agreement with the Privacy policy">Privacy policy</a>.
                </label>
                @error('privacy_policy')
                    <div class="invalid-feedback">
                        You have to agree with our
                        <a href="{{ route('privacy.policy') }}" target="_blank">Privacy policy</a>.
                    </div>
                @enderror
            </div>
        </fieldset>

        <div class="form-group">
            {{ Form::button('<i class="fas fa-save"></i> ' . __('auth.profile.update'), ['type' => 'submit', 'class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/picker.css') }}" />
@endsection

@section('scripts')
    @parent

    <!-- Required for modal, tooltips and date/time pickers -->
    <script src="{{ asset('js/jquery.min.js') }}" defer="defer"></script>

    <!-- Required for the avatar modal & tooltip -->
    <script src="{{ asset('js/popper.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/bootstrap.4.min.js') }}" defer="defer"></script>

    <!-- Required for the date/time pickers -->
    <script src="{{ asset('js/picker.js') }}" defer="defer"></script>
    <script src="{{ asset('js/picker.date.js') }}" defer="defer"></script>
    <script src="{{ asset('js/picker.time.js') }}" defer="defer"></script>
    <script src="{{ mix('js/pickers.js') }}" defer="defer"></script>

    <!-- Logic for enabling/disabling arrival inputs -->
    <script src="{{ mix('js/profile.js') }}" defer="defer"></script>
@endsection
