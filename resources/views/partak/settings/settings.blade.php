@extends('partak.settings.layout')
@section('inner-content')

  <div class="container">
    @if(session('successUpdate'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> Settings was successfully updated.
        </div>
    @endif

    <div class="row">
        <div class="col-md-7">
            {{ Form::model($settings, ['id' => 'mainForm', 'route' => 'partak.settings.general.save', 'method' => 'patch']) }}

            {{ Form::bsText('rector', 'Rector') }}

            <div class="form-group">
            {{ Form::label('limitPerDay', 'Buddy database limit per day', ['class' => 'control-label']) }}
            @if ($errors->has('limitPerDay'))
                <p class="error-block alert-danger">{{ $errors->first('limitPerDay') }}</p>
            @endif
            {{ Form::number('limitPerDay',$settings['limitPerDay'], ['class' => 'form-control']) }}
            </div>

            {{ Form::bsSelect('currentSemester', 'Current Semester', $semesters, $settings['currentSemester']) }}

            <div class="form-group">
                {{ Form::label('buddyDbFromDate', 'Buddy database open from', ['class' => 'control-label']) }}
                @if ($errors->hasAny(['buddyDbFromDate', 'buddyDbFromTime']))
                    <p class="error-block alert-danger">
                        @if($errors->has('buddyDbFromDate'))
                            {{ $errors->first('buddyDbFromDate') }}
                        @else
                            {{ $errors->first('buddyDbFromTime') }}
                        @endif
                    </p>
                @endif
                <div class="row">
                    <div class="col-sm-6 mb-2 mb-sm-0">
                        {{ Form::text(
                            'buddyDbFromDate',
                            $settings['buddyDbFrom']->format('d M Y'),
                            ['id' => 'buddyDbFromDate', 'class' => 'form-control date']
                        ) }}
                    </div>
                    <div class="col-sm-6">
                        {{ Form::text(
                            'buddyDbFromTime',
                            $settings['buddyDbFrom']->format('H:i'),
                            ['id' => 'buddyDbFromTime', 'class' => 'form-control time']
                        ) }}
                    </div>
                </div>
            </div>

            {{ Form::label('date', 'Welcome package from', ['class' => 'control-label']) }}
            @if ($errors->has('date'))
                <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
            @endif
            {{ Form::text('wcFrom', $settings['wcFrom']->format('d M Y'), ['id' => 'wcFrom', 'class' => 'form-control arrival date', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::label('date', 'OW from', ['class' => 'control-label']) }}
            @if ($errors->has('date'))
                <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
            @endif
            {{ Form::text('owFrom', $settings['owFrom']->format('d M Y'), ['id' => 'owFrom', 'class' => 'form-control arrival date', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::label('date', 'OW to', ['class' => 'control-label']) }}
            @if ($errors->has('date'))
                <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
            @endif
            {{ Form::text('owTo', $settings['owTo']->format('d M Y'), ['id' => 'owTo', 'class' => 'form-control arrival date', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::label('electionStreamUrl', 'Link to the election stream', ['class' => 'control-label']) }}
            @if ($errors->has('electionStreamUrl'))
                <p class="error-block alert-danger">{{ $errors->first('electionStreamUrl') }}</p>
            @endif
            {{ Form::url('electionStreamUrl', $settings['electionStreamUrl'], ['class' => 'form-control', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::label('fbGroupLink', 'Link to current semester\'s FB group', ['class' => 'control-label']) }}
            @if ($errors->has('fbGroupLink'))
                <p class="error-block alert-danger">{{ $errors->first('fbGroupLink') }}</p>
            @endif
            {{ Form::url('fbGroupLink', $settings['fbGroupLink'], ['class' => 'form-control', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::label('owFbEventLink', 'Link to currnet OW FB event', ['class' => 'control-label']) }}
            @if ($errors->has('owFbEventLink'))
            <p class="error-block alert-danger">{{ $errors->first('owFbEventLink') }}</p>
            @endif
            {{ Form::url('owFbEventLink', $settings['owFbEventLink'], ['class' => 'form-control', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::bsText('whatsAppAnnoucementsLink', 'Link to Annoucements WhatsApp group', '', @$settings['whatsAppAnnoucementsLink']) }}

            {{ Form::bsText('whatsAppGeneralLink', 'Link to General WhatsApp group', '', @$settings['whatsAppGeneralLink']) }}

            {{ Form::bsCheckbox('owTripsEnabled', 'Enable OW trips registration', '', '1', @$settings['owTripsEnabled']) }}

            {{ Form::bsCheckbox('owTripsRestricted', 'Allow only one OW trip per person', '', '1', @$settings['owTripsRestricted']) }}

            <div style="margin-bottom: 15px;">
            <input type="submit" value="Update settings" class="btn btn-primary btn-submit">
            </div>

            {{ Form::close() }}
        </div>
    </div>
@stop

@section('stylesheets')
    @parent
    <link href="{{ asset('/css/picker.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    @parent

    <script src="{{ asset('/js/picker.js') }}"></script>
    <script src="{{ asset('/js/picker.date.js') }}"></script>
    <script src="{{ asset('/js/picker.time.js') }}"></script>

    <script type="text/javascript">
    $('.date').pickadate({
        editable: true,
        firstDay: 1,
        format: 'dd mmm yyyy'
    });

    $('.time').pickatime({
        editable: true,
        format: 'HH:i'
    });
    </script>
@stop
