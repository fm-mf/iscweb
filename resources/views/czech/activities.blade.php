@extends('czech.layouts.layout')
@section('title', 'Co děláme')

@section('page')
    @include('czech.partials.activities-header')
    @include('czech.partials.activities-menu')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Zaujalo tě něco?</h2>
                    <p>
                        Můžeš buď kontaktovat konkrétní koordinátory na jejich e‑mailových adresách,
                        nebo pokud nemáš konkrétní představu, náš HR ti rád poradí.
                    </p>
                </div>
            </div>
            @isset($contactHr)
                <div class="row contacts">
                    <div class="col-auto mx-auto">
                        @include('partials.contact', ['contact' => $contactHr])
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <p>
                        Nechceš nám hned psát a radši by ses přišel podívat na nějakou naši akci?
                        Ty aktuální najdeš na naší
                        <a href="https://www.facebook.com/esn.ctu.prague/events/" target="_blank" rel="noopener">FB stránce</a>
                        nebo <a href="{{ route('czech.calendar') }}">tady v kalendáři</a>.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
