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

    {{ Form::model($buddy, ['url' => 'user/profile', 'method' => 'patch']) }}

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
        {{ Form::bsSubmit('Aktualizovat profil') }}

    {{ Form::close() }}


    <div class="footer row">
        <div class="col-sm-12">
            <p>V případě technických potíží nás kontaktuj na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
            <p>&copy; 2017 | International Student Club CTU in Prague, z.s.</p>
        </div>
    </div>
@stop