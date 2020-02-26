@extends('partak.settings.layout')
@section('inner-content')
  <div class="container">
    @if(session('successUpdate'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> Opening hours successfully updated
        </div>
    @endif

    {{ Form::model($settings, ['route' => 'partak.settings.openingHours.save', 'method' => 'patch']) }}

    {{ Form::bsSelect('openingHoursMode', 'Opening hours mode', $openingHoursModes, $settings['openingHoursMode'], ['id' => 'openingHoursMode']) }}

    {{ Form::label('openingHoursText', 'Opening hours text', ['class' => 'control-label']) }}<br>
    {{ Form::textarea('openingHoursText', $openingHoursText, ['class' => 'form-control']) }}<br>

    {{ Form::label('showOpeningHours', 'Show daily hours', ['class' => 'control-label']) }}
    {{ Form::checkbox( 'showOpeningHours', 'on', $showOpeningHours, ['id' => 'showOpeningHours'] ) }}

    <div id="openingHoursData">
      <div id="openingHoursTable">
      @foreach ( $openingHoursData as $day => $value )
        <div class="row mb-1 align-items-center">
          <div class="col-md-2 col-lg-1">
            <label for="openingHoursData-{{$day}}" class="mb-0">{{$day}}</label>
          </div>
          <div class="col-md-10">
            <input type="text" name="openingHoursData-{{ $day }}" id="openingHoursData-{{ $day }}" value="{{ $openingHoursData[ $day ] }}" class="form-control text ml-2">
          </div>
        </div>
      @endforeach
      </div>
    </div>

    <div id="editOpeningHoursSubmitButton" class="mt-4">
      <button type="submit" class="btn btn-primary btn-submit">
        <i class="fas fa-check"></i> Save changes
      </button>
    </div>
    
    {{ Form::close() }}
  </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ mix('/js/partak-settings-hours.js') }}"></script>
@stop