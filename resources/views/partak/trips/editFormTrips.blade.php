
<div class="row">
    <div class="form-group col-sm-6">
        {{ Form::label('registration_date', 'Registration starts', ['class' => 'required']) }}
        @if ($errors->has('registration_date'))
            <p class="error-block alert-danger">{{ $errors->first('registration_date') }}</p>
        @endif
        @if ($errors->has('registration_time'))
            <p class="error-block alert-danger">{{ $errors->first('registration_time') }}</p>
        @endif
        <div class="row date-row">
            <div class="col-sm-6">{{ Form::text('registration_date', $trip->registration_from ? $trip->registration_from->format('d M Y') : null, ['id' => 'registration_date', 'class' => 'form-control arrival date', 'required' => 'required']) }}</div>
            <div class="col-sm-6">{{ Form::text('registration_time', $trip->registration_from ? $trip->registration_from->format('g:i A') : null, ['id' => 'registration_time', 'class' => 'form-control arrival time', 'required' => 'required']) }}</div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('registration_date', 'Registration ends', ['class' => 'required']) }}
        @if ($errors->has('registration_end_date'))
            <p class="error-block alert-danger">{{ $errors->first('registration_end_date') }}</p>
        @endif
        @if ($errors->has('registration_end_time'))
            <p class="error-block alert-danger">{{ $errors->first('registration_end_time') }}</p>
        @endif
        <div class="row date-row">
            <div class="col-sm-6">{{ Form::text('registration_end_date', $trip->registration_to ? $trip->registration_to->format('d M Y') : null, ['id' => 'registration_end_date', 'class' => 'form-control arrival date', 'required' => 'required']) }}</div>
            <div class="col-sm-6">{{ Form::text('registration_end_time', $trip->registration_to ? $trip->registration_to->format('g:i A') : null, ['id' => 'registration_end_time', 'class' => 'form-control arrival time', 'required' => 'required']) }}</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        {{ Form::bsCheckbox('ow', 'Orientation Week event', '', '1', $trip->event->ow, [], 'students can only register for one Orientation Week event')  }}
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

<reservation
    :p-enabled="{{$event->reservations_enabled ? 'true' : 'false'}}"
    :p-expiration="{{$event->reservations_removal_limit ?: 5}}"
    :p-medical="{{$event->reservations_medical ? 'true' : 'false'}}"
    :p-diet="{{$event->reservations_diet ? 'true' : 'false'}}"
    :p-payment-on-spot="{{$event->reservations_payment_on_spot ? 'true' : 'false'}}"
></reservation>
