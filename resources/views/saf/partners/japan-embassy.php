@extends('layouts.saf.partner-subpage')

@section('title', 'Japonské informační a kulturní centrum &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-japan-embassy.jpg') }}" alt="Logo Embassy of Japan" title="Logo Embassy of Japan" class="logo" />
        </div>
        <h1>Japonské informační a kulturní centrum</h1>
        <p>JICC poskytuje informace o Japonsku, pořádá kulturní akce a zprostředkovává českým občanům stáže japonské vlády na japonských univerzitách.</p>
        <p>Centrum dále disponuje knihovnou s tituly v češtině, japonštině a angličtině a pro zájemce připravuje rozmanité propagační materiály. Každý měsíc se ve víceúčelovém sále centra konají přednášky, workshopy, promítání japonských filmů či výstavy. Na všechny akce JICC je vstup zdarma.</p>
    </section>
@endsection