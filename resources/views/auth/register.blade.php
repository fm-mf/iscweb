@extends('layouts.user')

@section('content')
    <h1>Registrace do Buddy Programu</h1>
    <div class="row">
        <div class="col-sm-12">
            <p class="description">
                Registrací získáš přístup do databáze přijíždějících zahraničních studentů.
            </p>
            <p class="description">
                V případě, že ses již registroval(a), pokračuj na <a href="https://www.isc.cvut.cz/muj-buddy/">přihlašovací stránku</a>.
            </p>
        </div>
    </div>

    {!! Form::open(['url' => '/user/register']) !!}
        @include('auth.partials.user')

    <div class="row">
        <div class="col-sm-12">
            <h2>Buddy Kodex</h2>
            <p class="grey">
            <p>Ke své úloze se stavíme zodpovědně a zahraničním studentům se snažíme pomáhat - to však neznamená, že jsme jejich sluhy. Naše vztahy by měly být převážně kamarádské. Zároveň si však uvědomujeme, že naše jednání ovlivňuje pověst ISC, ČVUT a potažmo celé České republiky. Proto se chováme tak, abychom ji nepoškozovali.</p>
            <p>Nebojíme se komunikovat i v případě, že cizí jazyky nejsou naší silnou stránkou. Naopak, v poznávání zahraničních studentů vidíme obrovskou příležitost a sami se od nich chceme něco naučit. V žádném případě je však nezneužíváme k vlastnímu prospěchu, ani ke komerčním účelům.</p>
            <p>Stává se, že si s nějakou situací nevíme rady. Jsme však jeden tým, a vždy se můžeme obrátit na ISC s žádostí o pomoc (<a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a>).</p>
        </div>

    </div>

    <div class="checkbox">
        <label class="col-sm-12">
            {{ Form::checkbox('kodex') }} Slibuji, že se budu držet Buddy kodexu.
        </label>
    </div>

        {{ Form::bsSubmit('Registrovat') }}
    {!! Form::close() !!}

    <div class="footer row">
        <div class="col-sm-12">
            <p>V případě technických potíží nás kontaktuj na <a href="mailto:buddy@isc.cvut.cz">buddy@isc.cvut.cz</a></p>
            <p>&copy; 2016 | International Student Club CTU in Prague, z.s.</p>
        </div>
    </div>
@endsection
