@extends('web.layouts.layout')

@section('title', 'Buddy programme profile')

@section('page')
    <div class="container" id="exchange-profile-form">
        @if (session('success'))
            <p class="alert alert-success" role="alert">
                <i class="fas fa-check fa-fw float-left"></i>
                <span class="d-block ml-4">Your profile has been successfully updated.</span>
            </p>
        @endif

        <h1>Buddy programme profile</h1>
        <p>
            Once you fill your profile, you'll be added to our Buddy programme database.
            Exchange students will start being assigned to Buddies from
            {{ $buddyDbFrom->format('l, j F Y') }} at {{ $buddyDbFrom->format('H:i') }}.
        </p>
        <p>
            You will receive an e-mail notification once you get a Buddy.
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
        </fieldset>

        <fieldset>
            <legend>🖼️ @lang('forms.profile-picture')</legend>
            @include('profile.avatar_bs4', [
                'avatar' => $student->person->avatar_url,
                'userHash' => $student->user->hash,
            ])
        </fieldset>

        {{ Form::model($student, ['route' => ['exchange.update', $student->user->hash], 'method' => 'patch']) }}

        <fieldset class="row">
            <legend class="col-12">✈️ Arrival information</legend>

            <p class="col-12">
                Arrival information is an important information for our Buddies.
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
                {{ Form::label('arrival_date', 'Day of arrival') }}
                @if ($errors->has('arrival_date'))
                    <p class="error-block alert-danger">{{ $errors->first('arrival_date') }}</p>
                @endif
                {{ Form::text('arrival_date', null, ['class' => 'date form-control arrival']) }}
            </div>
            <div class="form-group col-sm-6">
                {{ Form::label('arrival_time', 'Time of arrival') }}
                @if ($errors->has('arrival_time'))
                    <p class="error-block alert-danger">{{ $errors->first('arrival_time') }}</p>
                @endif
                {{ Form::text('arrival_time', null, ['class' => 'time form-control arrival']) }}
            </div>

            <div class="col-12">
                {{ Form::bsSelect(
                    'transportation',
                    'Means of transport',
                    $transportations,
                    null,
                    [
                        'placeholder' => 'Select transportation...',
                        'class' => 'arrival',
                    ]
                ) }}
            </div>
        </fieldset>

        <fieldset>
            <legend>🏢 Accommodation</legend>
            {{ Form::bsSelect('accommodation', null, $accommodations, null, ['placeholder' => 'Select accommodation...']) }}
        </fieldset>

        <fieldset>
            <legend>💭 About yourself</legend>

            <p>
                Tell your potential Buddy about your hobbies, interests, favourite movies or anything
                that you find important about yourself.
            </p>

            {{ Form::bsTextarea('about', null, '', null, ['placeholder' => 'Hobbies, interests, favourite movies...']) }}
        </fieldset>

        <fieldset>
            <legend>📇 Additional contacts</legend>

            <p>
                Your Buddy will receive your e-mail as a primary contact.
                If you want to provide more ways to contact you, you can enter them here.
            </p>

            {{ Form::bsTel('whatsapp', 'WhatsApp', null, $student->whatsapp, [], 'Full number, including your country prefix') }}
            {{ Form::bsUrl('facebook', 'Facebook', '', $student->facebook, [], 'Full link to your Facebook profile') }}
            {{ Form::bsText('instagram', 'Instagram', '', $student->instagram, [], 'Your Instagram handle without @') }}
        </fieldset>

        <fieldset>
            <legend>🌍 Country presentations</legend>

            <p>
                One category of events we organise during semester are Culture evenings,
                where students get a chance to present their country of origin,
                its culture, and even cook their national food. We'd like to know
                if you're interested in presenting your country at this event.
                Expressing your interest here is not binding.
            </p>

            <div class="form-group">
                <input type="hidden" name="willing_to_present" value="0" />
                <label>
                    {{ Form::checkbox('willing_to_present') }} I would like to present my country at any of the ISC events.
                </label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Out out</legend>
            <div class="form-group">
                <input type="hidden" name="opt_out" value="0" />
                <label>
                    {{ Form::checkbox('opt_out', 1, null, ['id' => 'opt_out']) }} I don't wish to have a Buddy
                </label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Privacy policy</legend>
            <div class="form-group">
                @if ($errors->has('privacy_policy'))
                    <p class="error-block alert-danger">
                        You have to agree with our
                        <a href="{{ route('privacy.policy') }}" target="_blank">Privacy policy</a>.
                    </p>
                @endif
                <label>
                    {{ Form::checkbox('privacy_policy', 1, null, ['required' => 'required']) }} I agree with the
                    <a href="{{ route('privacy.policy') }}" target="_blank" title="Agreement with the Privacy policy">Privacy policy</a>.
                </label>
            </div>
        </fieldset>

        {{ Form::bsSubmit('Update your profile') }}

        {{ Form::close() }}
    </div>
@endsection

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/picker.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ mix('css/exchange-profile.css') }}" />
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
