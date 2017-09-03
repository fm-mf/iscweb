@extends('layouts.saf.partner-subpage')

@section('title', 'Bakala Foundation &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-bakala-foundation.png') }}" alt="Logo Bakala Foundation" title="Bakala Foundation" class="logo" />
        </div>
        <h1>Bakala Foundation</h1>
        <p>Bakala Foundation je česká rodinná nadace Zdeňka a Michaely Bakalových.
            Byla založena v roce 2007 s cílem podporovat studium talentovaných studentů
            na prestižních zahraničních univerzitách prostřednictvím programu Scholarship.
            Nadace patří svou šíří podpory vzdělání a realizací dalších programů pro mladé talenty
            mezi jedinečné nadace v České republice. Během uplynulých let udělila stipendia již stovce studentů,
            kteří se prosazují v mnoha oblastech přírodních i humanitních věd,
            kulturním nebo veřejném životě či v korporacích v ČR i zahraničí.</p>
        <p>Součástí nadačních aktivit jsou také další vlastní programy a projekty zaměřené na rozvoj mladých talentů.
            Nadace podporuje mladé novináře a nezávislou žurnalistiku v rámci projektů Achillova data a Journey.
            Pro začínající architekty pořádá program Kaplicky Intership, který těm nejtalentovanějším otevírá cestu
            k získání praxe v prestižních evropských architektonických studiích.</p>
        <p>Nadace také provozuje Student Hub - poradenské centrum pro zájemce o studium v zahraničí,
            v rámci nějž zpřístupnila knihovnu, pořádá konzultace, veřejné debaty o vzdělávání
            a setkání s významnými osobnostmi.</p>
        <p>Více informací na <a href="http://www.bakalafoundation.org" target="_blank">www.bakalafoundation.org</a>.</p>
    </section>
@endsection