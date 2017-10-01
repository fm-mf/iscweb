@extends('layouts.saf.partner-subpage')

@section('title', 'DAAD &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-daad.jpg') }}" alt="Logo DAAD" title="Logo DAAD" class="logo" />
        </div>
        <h1>Deutscher Akademischer Austauschdienst</h1>
        <p>DAAD Praha (Německá akademická výměnná služba) poskytuje informace o studiu a výzkumu
            v&nbsp;Německu, o stipendiích DAAD i jiných organizací a poradí Vám, jak naplánovat
            studijní nebo výzkumný pobyt. IC DAAD je také partnerem pro české i zahraniční
            instituce v&nbsp;oblasti akademické spolupráce. IC DAAD Praha sídlí
            v&nbsp;Goethe-Institutu v&nbsp;Praze za Národním divadlem.</p>
    </section>
@endsection