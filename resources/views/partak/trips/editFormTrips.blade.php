<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('date', 'Event end date', ['class' => 'control-label']) }}
        @if ($errors->has('date'))
            <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
        @endif
        {{ Form::text('end_date', $trip->trip_date_to->format('d M Y'), ['id' => 'end_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('time', 'Event end time', ['class' => 'control-label']) }}
        @if ($errors->has('time'))
            <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
        @endif
        {{ Form::text('end_time', $trip->trip_date_to->format('g:i A'), ['id' => 'end_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('date', 'Registration from date', ['class' => 'control-label']) }}
        @if ($errors->has('date'))
            <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
        @endif
        {{ Form::text('registration_date', $trip->registration_from->format('d M Y'), ['id' => 'registration_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('time', 'Registration from time', ['class' => 'control-label']) }}
        @if ($errors->has('time'))
            <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
        @endif
        {{ Form::text('registration_time', $trip->registration_from->format('g:i A'), ['id' => 'registration_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>


<multiselectinput formName="form" title="organizers" :options="options.organizers" :value="options.sorganizers" :show-labels="true" label="last_name" track-by="id_user" placeholder="Organizers"
                  :multiple="true"></multiselectinput>

{{ Form::label('capacity', 'Capacity', ['class' => 'control-label']) }}
{{ Form::number('capacity', $trip->capacity, ['class' => 'form-control']) }}
{{ Form::label('price', 'Price', ['class' => 'control-label']) }}
{{ Form::number('price', $trip->price, ['class' => 'form-control']) }}