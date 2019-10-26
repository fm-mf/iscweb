<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('registration_date', 'Registration starts', ['class' => 'control-label required']) }}
        @if ($errors->has('registration_date'))
            <p class="error-block alert-danger">{{ $errors->first('registration_date') }}</p>
        @endif
        @if ($errors->has('registration_time'))
            <p class="error-block alert-danger">{{ $errors->first('registration_time') }}</p>
        @endif
        <div class="row date-row">
            <div class="col-sm-6">{{ Form::text('registration_date', $trip->registration_from->format('d M Y'), ['id' => 'registration_date', 'class' => 'form-control arrival date']) }}</div>
            <div class="col-sm-6">{{ Form::text('registration_time', $trip->registration_from->format('g:i A'), ['id' => 'registration_time', 'class' => 'form-control arrival time']) }}</div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('registration_date', 'Registration ends', ['class' => 'control-label required']) }}
        @if ($errors->has('registration_end_date'))
            <p class="error-block alert-danger">{{ $errors->first('registration_end_date') }}</p>
        @endif
        @if ($errors->has('registration_end_time'))
            <p class="error-block alert-danger">{{ $errors->first('registration_end_time') }}</p>
        @endif
        <div class="row date-row">
            <div class="col-sm-6">{{ Form::text('registration_end_date', $trip->registration_from->format('d M Y'), ['id' => 'registration_end_date', 'class' => 'form-control arrival date']) }}</div>
            <div class="col-sm-6">{{ Form::text('registration_end_time', $trip->registration_from->format('g:i A'), ['id' => 'registration_end_time', 'class' => 'form-control arrival time']) }}</div>
        </div>
    </div>
</div>


<multiselectinput
    form-name="organizers"
    title="Organizers"
    :options="options.organizers"
    :value="options.sorganizers"
    :show-labels="true"
    label="name"
    track-by="id_user"
    placeholder="Organizers"
    :multiple="true"
></multiselectinput>

{{ Form::bsSelect('type', 'Who can participate', $types, $trip->type)  }}
{{ Form::bsNumber('capacity', 'Capacity', 'required', $trip->capacity, ['min' => 0]) }}
{{ Form::bsNumber('price', 'Price', 'required', $trip->price, ['min' => 0]) }}
