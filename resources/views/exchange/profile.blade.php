@extends('layouts.user.user')

@section('content')
    <h1>Profile settings</h1>

    @if (session('success'))
        <div class="row">
            <div class="success">
                <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Your profile has been successfully updated.
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <p class="description">
            <h2>{{$student->person->first_name}} {{$student->person->last_name}}</h2>
            </p>
        </div>
    </div>
    <div class="row lab">
        <h3 class="col-sm-12"><span>PROFILE PICTURE</span></h3>
    </div>

    @include('profile.avatar')

    {{ Form::model($student, ['url' => 'exchange/', 'method' => 'patch']) }}

    <input type="hidden" name="hash" value="{{ $hash }}">

    <h3 class="col-sm-12"><span>ARRIVAL INFORMATION</span></h3>

    <div class="col-sm-12">
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
    <p class="help-block col-sm-12">You can also update the arrival information later.</p>

    <h3 class="col-sm-12"><span>ACCOMMODATION</span></h3>
    {{ Form::bsSelect('accommodation', null, $accommodations, $student->id_accommodation, ['placeholder' => 'Select accommodation...']) }}


    <h3 class="col-sm-12"><span>ABOUT YOURSELF</span></h3>
    {{ Form::bsTextarea('about', null) }}

    <!-- {{ Form::bsText('medical_issues', 'Medical issues','', $student->person->medical_issues) }} -->
    {{ Form::bsSelect('diet', 'Food preference', $diets, $student->person->diet, ['placeholder' => 'No preference'])  }}

    <h3 class="col-sm-12"><span>ADDITIONAL CONTACTS</span></h3>
    <p class="help-block col-sm-12">Your buddy will receive your e-mail as a primary contact. If you want to provide more ways to contact you, you can enter them here.</p>
    {{ Form::bsTel('whatsapp', 'WhatsApp', null, $student->whatsapp, [], 'Full number, with your country prefix') }}
    {{ Form::bsText('facebook', 'Facebook', '', $student->facebook, [], 'Full link to your facebook profile') }}

    <h3 class="col-sm-12"><span>COUNTRY PRESENTATION</span></h3>
    <div class="col-sm-12 form-group">
        <label>
            {{ Form::checkbox('wants_present', null, $wantsPresent) }} I would like to present my country in any of ISC events. (We are all interested in the difference of the nations.)
        </label>
    </div>

    <h3 class="col-sm-12"><span>OPT OUT</span></h3>
    <div class="col-sm-12 form-group">
        <label>
            {{ Form::checkbox('opt_out', null, $optedOut) }} I don't wish to have a buddy
        </label>
    </div>

    <h3 class="col-sm-12"><span>PRIVACY POLICY</span></h3>
    <div class="col-sm-12 form-group">
        @if ($errors->has('privacy_policy'))
            <p class="error-block alert-danger">You have to agree with our <a href="{{ action('Privacy\PrivacyController@showPrivacyPolicy') }}" target="_blank">Privacy policy</a>.</p>
        @endif
        <label>
            {{ Form::checkbox('privacy_policy', true, $student->privacy_policy) }} I agree with the <a href="{{ action('Privacy\PrivacyController@showPrivacyPolicy') }}" target="_blank" title="Agreement with the Privacy policy">Privacy policy.</a>
        </label>
    </div>

    {{ Form::bsSubmit('Update your profile') }}

    {{ Form::close() }}


    <div class="footer row">
        <div class="col-sm-12">
            <p>In case of technical issues, please, contact us at <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a></p>
            <p>If you have any questions, contact us at <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
            <p>&copy; {{ \Carbon\Carbon::now()->year }} | International Student Club CTU in Prague, z. s.</p>
        </div>
    </div>
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
