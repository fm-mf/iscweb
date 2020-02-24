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
            {{ Form::model($settings, ['id' => 'mainForm', 'url' => 'partak/settings', 'method' => 'patch']) }}
            {{ Form::bsSelect('isDatabaseOpen', 'Buddy database is', ['true' => 'Open', 'false' => 'Closed'], $settings['isDatabaseOpen'] ? 'true' : 'false')  }}
            {{ Form::bsText('rector', 'Rector') }}

            <div class="form-group">
            {{ Form::label('limitPerDay', 'Buddy database limit per day', ['class' => 'control-label']) }}
            @if ($errors->has('limitPerDay'))
                <p class="error-block alert-danger">{{ $errors->first('limitPerDay') }}</p>
            @endif
            {{ Form::number('limitPerDay',$settings['limitPerDay'], ['class' => 'form-control']) }}
            </div>

            {{ Form::bsSelect('currentSemester', 'Current Semester', $semesters, $settings['currentSemester']) }}

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
            <button type="button" id="editOpeningHoursButton" class="btn btn-warning">Edit opening hours</button>
            </div>
            <div style="margin-bottom: 15px;">
            <input type="submit" value="Update settings" class="btn btn-primary btn-submit">
            </div>

            {{ Form::close() }}
        </div>
    </div>

    <div style="min-height: 250px"></div>

    <div id="editOpeningHoursDialog" title="Edit opening hours">
      {{ Form::model($settings, ['url' => 'partak/settings', 'method' => 'patch']) }}
        <fieldset>
          {{ Form::bsSelect('openingHoursMode', 'Opening hours mode', $openingHoursModes, $settings['openingHoursMode'], ['id' => 'openingHoursMode', 'style' => 'margin-bottom: 20px;', 'class' => 'ui-widget-content ui-corner-all']) }}

           {{ Form::label('openingHoursText', 'Opening hours text', ['class' => 'control-label']) }}<br>
           {{ Form::textarea('openingHoursText', $openingHoursText, ['class' => 'ui-widget-content ui-corner-all form-control']) }}<br>

           {{ Form::label('showOpeningHours', 'Show daily hours', ['class' => 'control-label']) }}
           {{ Form::checkbox( 'showOpeningHours', 'on', $showOpeningHours, ['id' => 'showOpeningHours', 'class' => 'ui-widget-content ui-corner-all', 'style' => 'margin-bottom: 20px;'] ) }}

          <div id="openingHoursData">
          <table id="openingHoursTable" style="width: 100%;">
          @foreach ( $openingHoursData as $day => $value )
            <tr>
              <th>
                <label for="openingHoursData-{{$day}}">{{$day}}</label>
              </th>
              <td class="pull-right" style="padding: 0 0 5px 0">
                <input type="text" name="openingHoursData-{{ $day }}" id="openingHoursData-{{ $day }}" value="{{ $openingHoursData[ $day ] }}" class="form-control text ui-widget-content ui-corner-all">
              </td>
            </tr>
          @endforeach
          </table>
          </div>

          <div id="editOpeningHoursSubmitButton" style="margin-top: 10px; margin-bottom: 0;">
            <input type="submit" value="Save changes" class="btn btn-primary btn-submit pull-left">
            <button type="button" value="Cancel" id="dialogCancelButton" class="btn btn-danger btn-submit pull-right">Cancel</button>

          </div>
          {{ Form::close() }}
        </fieldset>
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
    <script src="{{ mix('/js/partak-settings-hours.js') }}"></script>
@stop
