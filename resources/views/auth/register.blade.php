@extends('layouts.user.user')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Registrace do Buddy Programu</h1>
        </div>
    </div>
    <div class="row alert alert-danger" lang="en">
        <div class="col-sm-12">
            <p class="description">
                <strong>Warning:</strong> This registration is for Czech students only!
                If you are an exchange student, please, <strong>do not register here</strong>.
                We will contact you through email with more information about how to get a buddy.
            </p>
            <p class="description">
                If you are a full-time student, please, contact us at
                <a href="mailto:buddy@isc.cvut.cz" class="alert-link">buddy@isc.cvut.cz</a>.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <p class="description">
                Registrací získáš přístup do databáze přijíždějících zahraničních studentů.
            </p>
            <p class="description">
                V&nbsp;případě, že ses již registroval(a), pokračuj na
                <a href="{{ action('Buddyprogram\ListingController@listExchangeStudents') }}">přihlašovací stránku</a>.
            </p>
        </div>
    </div>

    {!! Form::open(['action' => 'Auth\RegisterController@register']) !!}
        @include('auth.partials.user')

    <div class="row">
        <div class="col-sm-12">
            <h2>Buddy Kodex</h2>
            {{--<p class="grey">--}}
            <p>Ke své úloze se stavíme zodpovědně a zahraničním studentům se snažíme pomáhat –
                to však neznamená, že jsme jejich sluhy. Naše vztahy by měly být převážně
                kamarádské. Zároveň si však uvědomujeme, že naše jednání ovlivňuje pověst ISC,
                ČVUT a potažmo celé České republiky. Proto se chováme tak, abychom ji nepoškozovali.</p>
            <p>Nebojíme se komunikovat i v&nbsp;případě, že cizí jazyky nejsou naší silnou
                stránkou. Naopak, v&nbsp;poznávání zahraničních studentů vidíme obrovskou
                příležitost a sami se od nich chceme něco naučit. V&nbsp;žádném případě je však
                nezneužíváme k&nbsp;vlastnímu prospěchu, ani ke komerčním účelům.</p>
            <p>Stává se, že si s&nbsp;nějakou situací nevíme rady. Jsme však jeden tým, a vždy
                se můžeme obrátit na ISC s&nbsp;žádostí o pomoc
                (<a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>).</p>
        </div>

    </div>

    <div class="checkbox">
        @if ($errors->has('kodex'))
            <p class="error-block alert-danger">{{ $errors->first('kodex') }}</p>
        @endif
        <label class="col-sm-12">
            {{ Form::checkbox('kodex') }} Slibuji, že se budu držet Buddy kodexu.
        </label>
    </div>
    <div class="checkbox">
        @if ($errors->has('agreement'))
            <p class="error-block alert-danger">Souhlas se zpracováním musí být udělen.</p>
        @endif
        <label class="col-sm-12">
            {{ Form::checkbox('agreement') }} Souhlasím se <a href="{{ url('privacy/agreements-cs') }}" target="_blank", title="Souhlas se zpracováním osobních údajů">zpracováním osobních údajů.</a>
        </label>
    </div>
        {{ Form::bsSubmit('Registrovat') }}
    {!! Form::close() !!}

    <div class="footer row">
        <div class="col-sm-12">
            <p>V&nbsp;případě technických potíží nás kontaktuj na <a href="mailto:it@isc.cvut.cz">it@isc.cvut.cz</a></p>
            <p>&copy;&nbsp;2018 | International Student Club CTU in Prague, z.&nbsp;s.</p>
        </div>
    </div>
@endsection
