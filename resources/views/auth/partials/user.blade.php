{{ Form::bsText('email', 'Email', old('email'), []) }}

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('first_name', 'Jméno', ['class' => 'control-label']) }}
        {{ Form::text('first_name', old('first_name'), ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-6 right">
        {{ Form::label('last_name', 'Příjmení', ['class' => 'control-label']) }}
        {{ Form::text('last_name', old('last_name'), ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-6 info"></div>
</div>

{{ Form::bsPassword('password', 'Heslo', [], 'Heslo musí obsahovat alespoň 8 znaků.') }}
{{ Form::bsPassword('password_confirmation', 'Potvrzení hesla', []) }}