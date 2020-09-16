@extends('layouts.user.user')

@section('title')
    <h1>Buddy Program</h1>
    <h2>Student profile</h2>
@stop

@section('content')
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
            <small class="form-text text-muted">This e-mail will be used whenever we need to contact you. If you want to change it, write us at <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a>.</small>
        </div>
    </div>

    <fieldset>
        <legend>🖼️ Profile picture</legend>
        @include('profile.avatar')
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
                {{ Form::text('date', $currentDate, ['id' => 'date', 'class' => 'form-control arrival']) }}
                <div id="picker">
                </div>
            </div>
            <div class="col-sm-6 right">
                {{ Form::label('time', 'Time of arrival', ['class' => 'control-label']) }}
                @if ($errors->has('time'))
                    <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
                @endif
                {{ Form::text('time', $currentTime, ['id' => 'time', 'class' => 'form-control arrival']) }}
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

    <footer>
        <p>In case of technical issues, please, contact us at <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a></p>
        <p>If you have any questions, contact us at <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
        <p>&copy; {{ \Carbon\Carbon::now()->year }} | International Student Club CTU in Prague, z. s.</p>
    </footer>
@stop

@section('stylesheets')
    @parent
    <link href="{{ URL::asset('/css/picker.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    @parent

    <script>
        $(".chosen").chosen();

        $(document).ready(function() {
            $( ".chosen" ).on( "change", function() {
                window.location.replace("https://isc.cvut.cz/muj-buddy/exchange/"+$(this).attr("name")+"/"+$(this).val());
            });
        });
    </script>

    <script src="{{ URL::asset('/js/picker.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.time.js') }}"></script>

    <script  type="text/javascript">
        function change() {
            if($("#arrival").is(':checked')) {
                $('.arrival').prop('disabled', true);
            } else {
                $('.arrival').prop('disabled', false);
            }
        }
        $('#arrival').change(function() {
            change();
        })
        $( document ).ready(function() {
            change();
        });
        var $inputDate = $('#date').pickadate({
            editable: true,
            firstDay: 1,
            container: '#picker',
            format: 'dd mmm yyyy'
        });
        var picker = $inputDate.pickadate('picker');
        //picker.set('view', new Date({!$date}));
        var $inputTime = $('#time').pickatime({
            editable: true
        });
    </script>
@stop
