{{ Form::bsText('email', 'E-mail','', old('email'), []) }}

<div class="form-group row">
    <div class="col-sm-6 left">
        {{ Form::label('first_name', 'Jméno', ['class' => 'control-label']) }}
        @if ($errors->has('first_name'))
            <p class="error-block alert-danger">{{ $errors->first('first_name') }}</p>
        @endif
        {{ Form::text('first_name', old('first_name'), ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-6 right">
        {{ Form::label('last_name', 'Příjmení', ['class' => 'control-label']) }}
        @if ($errors->has('last_name'))
            <p class="error-block alert-danger col-sm-12">{{ $errors->first('last_name') }}</p>
        @endif
        {{ Form::text('last_name', old('last_name'), ['class' => 'form-control']) }}
    </div>
    <div class="col-sm-6 info"></div>

</div>

{{ Form::bsPassword('password', 'Heslo', [], 'Heslo musí obsahovat alespoň 8 znaků.') }}
{{ Form::bsPassword('password_confirmation', 'Potvrzení hesla', []) }}
{{ Form::bsSelect('id_country', 'Země původu', $countries, ['placeholder' => 'Vyber zemi...', 'default' => $id_cz]) }}
