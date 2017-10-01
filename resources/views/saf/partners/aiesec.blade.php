@extends('layouts.saf.partner-subpage')

@section('title', 'AIESEC &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-aiesec.png') }}" alt="Logo AIESEC" title="Logo AIESEC" class="logo" />
        </div>
        <h1>AIESEC</h1>
        <p>AIESEC je největší studenty řízená organizace na světě, která přispívá společnosti
            rozvojem mladých lidí a příležitostmi v&nbsp;mezinárodním prostředí. AIESEC existuje
            od roku 1948 a působí momentálně ve 126 zemích a teritoriích.</p>
    </section>
@endsection