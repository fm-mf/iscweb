

{{ Form::bsText('name', 'Name') }}

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('date', 'Visible from date', ['class' => 'control-label']) }}
        @if ($errors->has('date'))
            <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
        @endif
        {{ Form::text('visible_date',($event->visible_from) ? $event->visible_from->format('d M Y') :'', ['id' => 'visible_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('time', 'Visible from time', ['class' => 'control-label']) }}
        @if ($errors->has('time'))
            <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
        @endif
        {{ Form::text('visible_time', $event->visible_from->format('g:i A'), ['id' => 'visible_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('date', 'Event starts date', ['class' => 'control-label']) }}
        @if ($errors->has('date'))
            <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
        @endif
        {{ Form::text('start_date', $event->datetime_from->format('d M Y'), ['id' => 'start_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('time', 'Event starts time', ['class' => 'control-label']) }}
        @if ($errors->has('time'))
            <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
        @endif
        {{ Form::text('start_time', $event->datetime_from->format('g:i A'), ['id' => 'start_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>
@if($trips)
    @include('partak.trips.editFormTrips')
@endif

{{ Form::bsText('facebook_url', 'Facebook event (url)') }}
{{ Form::bsTextarea('description', 'Description (in English)') }}


@section('stylesheets')
    @parent
    <link href="{{ URL::asset('/css/picker.css') }}" rel="stylesheet" type="text/css">
@stop

@section('scripts')
    @parent

    <script src="{{ URL::asset('/js/picker.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.date.js') }}"></script>
    <script src="{{ URL::asset('/js/picker.time.js') }}"></script>

    <script  type="text/javascript">

        var $inputDate = $('.date').pickadate({
            editable: true,
            firstDay: 1,
            format: 'dd mmm yyyy'
        });

        //var picker = $inputDate.pickadate('picker');
        //picker.set('view', new Date({!$date}));
        var $inputTime = $('.time').pickatime({
            editable: true
        });
    </script>
@stop