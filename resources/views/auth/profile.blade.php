@extends('layouts.user')

@section('content')
    <h1>Nastavení profilu</h1>
    <div class="row">
        <div class="col-sm-12">
            <p class="description">
                Tyto údaje jsou nepovinné. Jejich vyplnění nám však může ušetřit spoustu práce v případě, že nastanou problémy.
            </p>
        </div>
    </div>

    @include('profile.avatar')

    {{ Form::open(['url' => 'user/profile', 'method' => 'patch']) }}
        {{ Form::bsText('phone', 'Telefon') }}
        {{ Form::bsSelect('faculty', 'Fakulta', $faculties, null, ['placeholder' => 'Vyber fakultu...']) }}

        <div class="form-group row">
            <div class="col-sm-6 left">
                {{ Form::label('sex', 'Jsi', ['class' => 'control-label']) }}
                {{ Form::select('sex', ['male' => 'Muž', 'female' => 'Žena'], null, ['placeholder' => 'Vyber pohlaví...', 'class' => 'form-control']) }}
            </div>
            <div class="col-sm-6 right">
                {{ Form::label('year', 'Rok narozeni', ['class' => 'control-label']) }}
                {{ Form::number('year', null, ['class' => 'form-control']) }}
            </div>
            <div class="col-sm-6 info"></div>
        </div>

        {{ Form::bsTextarea('about', 'O Tobě') }}
        {{ Form::bsSubmit('Aktualizovat profil') }}

    {{ Form::close() }}


    <div class="footer row">
        <div class="col-sm-12">
            <p>V případě technických potíží nás kontaktuj na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
            <p>&copy; 2017 | International Student Club CTU in Prague, o.s.</p>
        </div>
    </div>
@stop