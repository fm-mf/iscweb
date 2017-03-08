<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('date', 'Event end date', ['class' => 'control-label required']) }}
        @if ($errors->has('date'))
            <p class="error-block alert-danger">{{ $errors->first('date') }}</p>
        @endif
        {{ Form::text('end_date', $trip->trip_date_to->format('d M Y'), ['id' => 'end_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('time', 'Event end time', ['class' => 'control-label required']) }}
        @if ($errors->has('time'))
            <p class="error-block alert-danger">{{ $errors->first('time') }}</p>
        @endif
        {{ Form::text('end_time', $trip->trip_date_to->format('g:i A'), ['id' => 'end_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('registration_date', 'Registration from date', ['class' => 'control-label required']) }}
        @if ($errors->has('registration_date'))
            <p class="error-block alert-danger">{{ $errors->first('registration_date') }}</p>
        @endif
        {{ Form::text('registration_date', $trip->registration_from->format('d M Y'), ['id' => 'registration_date', 'class' => 'form-control arrival date']) }}

    </div>
    <div class="col-sm-6 right">
        {{ Form::label('registration_time', 'Registration from time', ['class' => 'control-label required']) }}
        @if ($errors->has('registration_time'))
            <p class="error-block alert-danger">{{ $errors->first('registration_time') }}</p>
        @endif
        {{ Form::text('registration_time', $trip->registration_from->format('g:i A'), ['id' => 'registration_time', 'class' => 'form-control arrival time']) }}

    </div>
    <div class="col-sm-6 info"></div>
</div>


<multiselectinput form-name="organizers" title="Organizers" :options="options.organizers" :value="options.sorganizers" :show-labels="true" label="name" track-by="id_user" placeholder="Organizers"
                  :multiple="true"></multiselectinput>

{{ Form::bsSelect('type', 'Who can participate', $types, $trip->type)  }}
{{ Form::label('capacity', 'Capacity', ['class' => 'control-label required']) }}
@if ($errors->has('capacity'))
    <p class="error-block alert-danger">{{ $errors->first('capacity') }}</p>
@endif
{{ Form::number('capacity', $trip->capacity, ['class' => 'form-control']) }}
{{ Form::label('price', 'Price', ['class' => 'control-label required']) }}
@if ($errors->has('price'))
    <p class="error-block alert-danger">{{ $errors->first('price') }}</p>
@endif
{{ Form::number('price', $trip->price, ['class' => 'form-control']) }}
