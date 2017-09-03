@extends('layouts.saf.partner-subpage')

@section('title', 'IAESTE &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-iaeste-horizontal.png') }}" alt="Logo IAESTE" title="Logo IAESTE" class="logo" />
        </div>
        <h1>IAESTE</h1>
    </section>

    <section>
    <h2>IAESTE International</h2>
    <p>IAESTE International (The International Association for the Exchange of Students for Technical Experience
        - Mezinárodní organizace pro výměnu studentů za účelem získání technické praxe)
        je mezinárodní, nevládní, nepolitická a nezisková organizace, která sdružuje mladé lidi
        bez ohledu na náboženství, národnost, barvu pleti, původu nebo pohlaví.</p>
    <p>IAESTE byla založena v roce 1948 v Londýně a tehdejší Československo bylo zakládající zemí.
        Za dobu více jak 60-leté činnosti jejím prostřednictvím vyjelo na odborné praxe přes 4000 studentů ročně.
        Hlavním cílem IAESTE ČR je podporovat zvyšování úrovně odborných a jazykových znalostí studentů a absolventů.
        Nejvýznamnější aktivitou IAESTE je mezinárodní výměnný program. IAESTE ČR zprostředkuje každoročně
        zahraniční praxe pro téměř stovku studentů celé České republiky.</p>
    </section>

    <section>
        <h2>IAESTE Czech Republic</h2>
        <p>IAESTE Czech Republic si klade za cíl pokračovat v úspěšné tradici aktivit a projektů
            v oblasti personálního managementu a zvýšit počet zajištěných zahraničních odborných praxí pro české studenty.
            Jsme si vědomi, že uplatnění absolventa na trhu práce je velmi ošemetná otázka
            a naše projekty si kladou jediný cíl: Pomoci vám při vašem snažení uspět na trhu práce.</p>
        <p>Více informací o IAESTE naleznete na mezinárodních stránkách <a href="http://iaeste.org" target="_blank">iaeste.org</a>.</p>
    </section>
@endsection