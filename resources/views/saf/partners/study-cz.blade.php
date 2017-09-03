@extends('layouts.saf.partner-subpage')

@section('title', 'Study.cz &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-study-cz.png') }}" alt="Logo Study.cz" title="Logo Study.cz" class="logo" />
        </div>
        <h1>Study.cz</h1>
        <p>Portál Study.cz, stejně jako renomovaný portál letuška.cz, provozuje společnost ASIANA spol. s r. o.</p>
        <p>ASIANA spol. s r. o. byla založena v roce 1993 a jako první v ČR odbavovala studenty za studiem nejen
            do evropských škol, ale i do daleké Austrálie. Dvacet čtyři let na trhu znamená neocenitelné zkušenosti
            s poradenskou činností, výběrem škol i samotným odbavováním klientů, kteří se rozhodli investovat
            do budoucnosti formou studia v zahraničí.</p>
        <p>V nabídce <a href="http://www.study.cz/" target="_blank">Study.cz</a> se nachází jen školy námi navštívené,
            ověřené nebo jednotlivé pobočky osvědčeného řetězce. Navíc díky spolupráci s ostatními projekty společnosti
            Asiana zajišťujeme jazykový kurz v zahraničívčetně letenek, víz, extra ubytování či pojištění.</p>
        <p>Jsme hrdí, že pomáháme nejen mladým lidem ke vzdělání.
            Naším krédem je upřednostňování kvality před kvantitou a individuální přístup k potřebám našich klientů.</p>
    </section>
@endsection