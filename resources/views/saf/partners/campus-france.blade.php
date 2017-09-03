@extends('layouts.saf.partner-subpage')

@section('lang', 'en')

@section('title', 'Campus France &ndash; ')

@section('page')
    @parent

    <section>
        <div>
            <img src="{{ asset('img/saf/partners/logo-campus-france.png') }}" alt="Logo Campus France" title="Logo Campus France" class="logo" />
        </div>
        <h1>Campus France</h1>
        <p>Campus France is the French national agency for the promotion of higher education, international student services and international mobility.</p>
        <p>Campus France Czech Republic will help you through the various steps of your departure to France. You can get personalized support free of charge regarding:</p>
        <ul>
            <li>Comprehensive information on French higher education (universities, Grandes Ecoles, specialized schools…)</li>
            <li>Information about available scholarships</li>
            <li>Orientation: choosing the best program for you among 36000 possibilities, in French or in English!</li>
            <li>Assistance with your applications to universities and scholarships.</li>
            <li>Preparation of your departure (accommodation, life style in France, student jobs…)</li>
        </ul>
    </section>
@endsection