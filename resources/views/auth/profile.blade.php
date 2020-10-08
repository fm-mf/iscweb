@extends('layouts.user.user')

@section('content')
    <h1>Nastavení profilu</h1>

    @if (session('success'))
    <div class="row">
        <div class="success">
            <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Tvůj profil byl úspěšně aktualizován
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <p class="description">
                Tyto údaje jsou nepovinné. Jejich vyplnění nám však může ušetřit spoustu práce v případě, že nastanou problémy.
            </p>
        </div>
    </div>

    @include('profile.avatar')

    {{ Form::model($buddy, ['action' => 'Auth\ProfileController@updateProfile', 'method' => 'patch']) }}

        {{ Form::bsText('phone', 'Telefon') }}
        {{ Form::bsSelect('id_faculty', 'Fakulta', $faculties, $buddy->id_faculty, ['placeholder' => 'Vyber fakultu...']) }}

        <div class="form-group row">
            <div class="col-sm-6 left">
                {{ Form::label('sex', 'Jsi', ['class' => 'control-label']) }}
                @if ($errors->has('sex'))
                    <p class="error-block alert-danger">{{ $errors->first('sex') }}</p>
                @endif
                {{ Form::select('sex', ['M' => 'Muž', 'F' => 'Žena'], $buddy->person->sex, ['placeholder' => 'Vyber pohlaví...', 'class' => 'form-control']) }}
            </div>
            <div class="col-sm-6 right">
                {{ Form::label('age', 'Rok narozeni', ['class' => 'control-label']) }}
                @if ($errors->has('age'))
                    <p class="error-block alert-danger">{{ $errors->first('age') }}</p>
                @endif
                {{ Form::number('age', $buddy->person->age, ['class' => 'form-control']) }}
            </div>
            <div class="col-sm-6 info"></div>
        </div>

        {{ Form::bsTextarea('about', 'O Tobě') }}

        <div class="checkbox">
            @if ($errors->has('subscribed'))
                <p class="error-block alert-danger">{{ $errors->first('subscribed') }}</p>
            @endif
            <label class="col-sm-12">
                {{ Form::checkbox('subscribed') }} Souhlasím s občasným zasíláním informací o dění v ISC
                (např. informace o otevření databáze či o nadcházejících akcích).
            </label>
        </div>

        {{ Form::bsSubmit('Aktualizovat profil') }}

    {{ Form::close() }}


    <div class="footer row">
        <div class="col-sm-12">
            <p>V případě technických potíží nás kontaktuj na <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a></p>
            <p>&copy; {{ \Carbon\Carbon::now()->year }} | International Student Club CTU in Prague, z.&nbsp;s.</p>
        </div>
    </div>
@stop
