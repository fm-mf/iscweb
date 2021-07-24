@extends('web.layouts.layout')

@section('title')
    Buddy Program Profile
@stop

@section('page')
    <div class="container-small exchange-profile">
        <h2 class="my-5">Buddy Program Profile</h2>

        <div class="form-text my-5 text-muted">
            <p>Once you fill your profile, you'll be added to our Buddy Program database. Buddies will start being assigned on {{ $buddyDbFrom->formatLocalized('%e %B %Y') }} at {{ $buddyDbFrom->formatLocalized('%k:%M') }}.</p>
            <p>You'll receive an e-mail notification if you get a buddy. It's also likely, that your buddy will attempt to contact you using provided contact methods.</p>
        </div>

        @if (session('success'))
            <div class="row">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Your profile has been successfully updated.
                </div>
            </div>
        @endif

        <div class="row">
            <div class="form-group col-sm-6">
                <label class='control-label'>Full Name</label>
                <input class='form-control' type="text" disabled value="{{$student->person->first_name}} {{$student->person->last_name}}" />
            </div>

            <div class="form-group col-sm-6">
                <label class='control-label'>E-mail</label>
                <input class='form-control' type="text" disabled value="{{$student->user->email}}" />
                <small class="form-text text-muted">This e-mail will be used whenever we need to contact you. If you want to change it, contact us at <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a>.</small>
            </div>
        </div>

        <fieldset class="my-4">
            <legend>🖼️ @lang('forms.profile-picture')</legend>
            @include('profile.avatar_bs4')
        </fieldset>

        {{ Form::model($student, ['url' => 'exchange/', 'method' => 'patch']) }}

        <input type="hidden" name="hash" value="{{ $hash }}">

        <fieldset>
            <legend>✈️ Arrival information</legend>

            <small class="help-block form-text text-muted col-sm-12">Arrival information is important information for our Buddies. If you don't know the information now, you can also update the arrival information later.</small>

            <div class="form-group">
                <label>
                    <input type="checkbox" name="arrival_skipped" id="arrival"> I don't know when I'll arrive yet.
                </label>
            </div>

            <div class="form-group row">
                <div class="col-sm-6 left">
                    {{ Form::label('date', 'Day of arrival', ['class' => 'control-label']) }}
                    @if ($errors->has('date'))
                        <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
                    @endif
                    {{ Form::text('date', $currentDate, ['id' => 'date', 'class' => 'date form-control arrival']) }}
                    <div id="picker">
                    </div>
                </div>
                <div class="col-sm-6 right">
                    {{ Form::label('time', 'Time of arrival', ['class' => 'control-label']) }}
                    @if ($errors->has('time'))
                        <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
                    @endif
                    {{ Form::text('time', $currentTime, ['id' => 'time', 'class' => 'time form-control arrival']) }}
                </div>
                <div class="col-sm-6 info"></div>
            </div>

            {{ Form::bsSelect('transportation', 'Means of transport', $transportations, $currentTransportation, ['placeholder' => 'Select transportation...', 'class' => 'arrival']) }}
        </fieldset>

        <fieldset>
            <legend>🏢 Accommodation</legend>
            {{ Form::bsSelect('accommodation', null, $accommodations, $student->id_accommodation, ['placeholder' => 'Select accommodation...']) }}
        </fieldset>

        <fieldset>
            <legend>💭 About yourself</legend>
            <small class="help-block form-text text-muted col-sm-12">Tell your potential buddy about your hobbies, interests, favourite movies or anything that you find important about yourself.</small>

            {{ Form::bsTextarea('about', null, '', null, ['placeholder' => 'Hobbies, interests, favourite movies...']) }}

            <!-- {{ Form::bsText('medical_issues', 'Medical issues','', $student->person->medical_issues) }} -->
            {{ Form::bsSelect('diet', 'Food preference', $diets, $student->person->diet, ['placeholder' => 'No preference'])  }}
        </fieldset>

        <fieldset>
            <legend>📇 Additional contacts</legend>
            <small class="help-block form-text text-muted col-sm-12">Your buddy will receive your e-mail as a primary contact. If you want to provide more ways to contact you, you can enter them here.</small>
            {{ Form::bsTel('whatsapp', 'WhatsApp', null, $student->whatsapp, [], 'Full number, with your country prefix') }}
            {{ Form::bsText('facebook', 'Facebook', '', $student->facebook, [], 'Full link to your facebook profile') }}
            {{ Form::bsText('instagram', 'Instagram', '', $student->instagram, [], 'Your instagram handle without @') }}
        </fieldset>

        <fieldset>
            <legend>🌍 Country presentations</legend>

            <small class="help-block form-text text-muted col-sm-12">One of the events we organize during semester is Culture Evening, where students get a chance to present their country of origin and even cook their national food. We'd like to know if you're interested in presenting your country at this event. Expressing your interest here is not binding.</small>

            <div class="form-group">
                <label>
                    {{ Form::checkbox('wants_present', null, $wantsPresent) }} I would like to present my country in any of ISC events.
                </label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Out out</legend>
            <div class="form-group">
                <label>
                    {{ Form::checkbox('opt_out', null, $optedOut) }} I don't wish to have a buddy
                </label>
            </div>
        </fieldset>

        <fieldset>
            <legend>Privacy policy</legend>
            <div class="form-group">
                @if ($errors->has('privacy_policy'))
                    <p class="error-block alert-danger">You have to agree with our <a href="{{ action('Privacy\PrivacyController@showPrivacyPolicy') }}" target="_blank">Privacy policy</a>.</p>
                @endif
                <label>
                    {{ Form::checkbox('privacy_policy', true, $student->privacy_policy) }} I agree with the <a href="{{ action('Privacy\PrivacyController@showPrivacyPolicy') }}" target="_blank" title="Agreement with the Privacy policy">Privacy policy.</a>
                </label>
            </div>
        </fieldset>

        {{ Form::bsSubmit('Update your profile') }}

        {{ Form::close() }}
    </div>
@stop

@section('stylesheets')
    @parent
    <link href="{{ URL::asset('/css/picker.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    @parent

    <!-- Required for tooltips and date/time pickers -->
    <script src="{{ asset('js/jquery.min.js') }}" defer="defer"></script>
   
    <!-- Required for the avatar tooltip -->
    <script src="{{ asset('js/popper.min.js') }}" defer="defer"></script>
    <script src="{{ asset('js/bootstrap.4.min.js') }}" defer="defer"></script>

    <!-- Required for the date/time pickers -->
    <script src="{{ URL::asset('/js/picker.js') }}" defer="defer"></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}" defer="defer"></script>
    <script src="{{ URL::asset('/js/picker.time.js') }}" defer="defer"></script>
    <script src="{{ URL::asset('/js/pickers.js') }}" defer="defer"></script>

    <!-- Logic for enabling/disabling arrival stuff -->
    <script src="{{ URL::asset('/js/profile.js') }}" defer="defer"></script>
@stop
