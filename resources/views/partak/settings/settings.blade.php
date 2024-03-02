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

            <x-settings.date-time-select
                :date-time="$settings['buddyDbFrom']"
                key="buddyDbFrom"
                label="Buddy database open from"
            />

            <x-settings.date-time-select
                :date-time="$settings['degreeBuddyDbFrom']"
                key="degreeDbFrom"
                label="Degree Buddy database open from"
            />

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

            {{ Form::label('owFbEventLink', 'Link to current OW FB event', ['class' => 'control-label']) }}
            @if ($errors->has('owFbEventLink'))
            <p class="error-block alert-danger">{{ $errors->first('owFbEventLink') }}</p>
            @endif
            {{ Form::url('owFbEventLink', $settings['owFbEventLink'], ['class' => 'form-control', 'style' => 'margin-bottom: 15px']) }}

            {{ Form::bsText('whatsAppAnnoucementsLink', 'Link to Annoucements WhatsApp group', '', @$settings['whatsAppAnnoucementsLink']) }}

            {{ Form::bsText('whatsAppGeneralLink', 'Link to General WhatsApp group', '', @$settings['whatsAppGeneralLink']) }}

            <div class="form-group">
                {{ Form::label('discordInviteBuddy', 'ESN Discord invite link for Buddies') }}
                @error('discordInviteBuddy')
                    <p class="error-block alert-danger">{{ $message }}</p>
                @enderror
                {{ Form::url('discordInviteBuddy', $settings['discordInviteBuddy'], ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('discordInviteExchange', 'ESN Discord invite link for Exchange students') }}
                @error('discordInviteExchange')
                    <p class="error-block alert-danger">{{ $message }}</p>
                @enderror
                {{ Form::url('discordInviteExchange', $settings['discordInviteExchange'], ['class' => 'form-control']) }}
            </div>

            {{ Form::bsCheckbox('owTripsEnabled', 'Enable OW trips registration', '', '1', @$settings['owTripsEnabled']) }}

            {{ Form::bsCheckbox('owTripsRestricted', 'Allow only one OW trip per person', '', '1', @$settings['owTripsRestricted']) }}

            {{ Form::label('receiptPrinterUrl', 'Receipt printer url', ['class' => 'control-label']) }}
            @if ($errors->has('receiptPrinterUrl'))
            <p class="error-block alert-danger">{{ $errors->first('receiptPrinterUrl') }}</p>
            @endif
            {{ Form::url('receiptPrinterUrl', @$settings['receiptPrinterUrl'], ['class' => 'form-control', 'style' => 'margin-bottom: 15px']) }}

            <div class="form-group">
                {{ Form::label('membershipFee', 'Membership fee') }}
                <div class="input-group @error('membershipFee') is-invalid @enderror">
                    {{ Form::number('membershipFee', null, ['class' => 'form-control' . ($errors->has('membershipFee') ? ' is-invalid' : '')]) }}
                    <div class="input-group-append">
                        <span class="input-group-text">CZK</span>
                    </div>
                </div>
                @error('membershipFee')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

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

    <script src="{{ asset('/js/picker.js') }}" defer></script>
    <script src="{{ asset('/js/picker.date.js') }}" defer></script>
    <script src="{{ asset('/js/picker.time.js') }}" defer></script>

    <script src="{{ mix('/js/pickers.js') }}" defer></script>
@stop
