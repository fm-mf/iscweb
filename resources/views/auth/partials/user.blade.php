{{ Form::bsText('email', 'Email', null, []) }}

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('first_name', 'Jmeno', ['class' => 'control-label']) }}
        {{ Form::text('first_name', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-6 right">
        {{ Form::label('last_name', 'Prijmeni', ['class' => 'control-label']) }}
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-6 info"></div>
</div>

{{ Form::bsText('password', 'Heslo', null, []) }}
{{ Form::bsText('password_confirmation', 'Potvrzeni hesla', null, []) }}