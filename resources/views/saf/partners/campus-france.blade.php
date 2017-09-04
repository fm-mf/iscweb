@extends('layouts.saf.partner-subpage')

@section('title', 'Campus France &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-campus-france.png') }}" alt="Logo Campus France" title="Logo Campus France" class="logo" />
        </div>
        <h1>Campus France</h1>
        <p>Espace Campus France Česká republika (ECF) sídlí ve Francouzském institutu
            a nabízí informační službu českým studentům,
            kteří chtějí začít nebo pokračovat ve studiích ve Francii.</p>
        <p>Campus France doprovází zájemce individuálním a konkrétním způsobem
            při přípravě projektu studií ve Francii. Jedná se zejména o:</p>
        <ul>
            <li>Informace o francouzském vysokoškolském systému</li>
            <li>Analýzu a pomoc při hledání a výběr vhodného studijního programu
                ve Francouzštině nebo Angličtině z více než 36000 možností</li>
            <li>Pomoc s vypracováním přihlášky ke studiu i žádosti o stipendium</li>
            <li>Rady o praktickém životě ve Francii, ubytování či studentských brigádách</li>
        </ul>
    </section>
@endsection