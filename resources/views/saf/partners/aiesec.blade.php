@extends('layouts.saf.partner-subpage')

@section('title', 'AIESEC &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-aiesec.png') }}" alt="Logo AIESEC" title="Logo AIESEC" class="logo" />
        </div>
        <h1>AIESEC</h1>
    </section>
@endsection