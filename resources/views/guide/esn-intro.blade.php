@extends('guide.layouts.subpage')

@section('subtitle', 'ESN')

@section('subpage')
    <section id="esn-intro">
        <h2>Erasmus Student Network</h2>
        <p>Erasmus Student Network (ESN) is the biggest student association in Europe.
            It was born on the 16th October 1989 and legally registered in 1990
            for supporting and developing student exchange.
            It is present in more than 900 Higher Education Institutions from 40 countries.
            The network is constantly developing and expanding.
            We have around 15,000 active members that are in many sections (ESN CTU in Prague is one of them)
            supported by so called buddies taking care of international students.
            Thus, ESN involves around 40,000 young people offering its services to around 220,000 international students every year.</p>
    </section>

    <section id="esn-cz-intro">
        <h3>Erasmus Student Network Czech Republic</h3>
        <p>Erasmus Student Network Czech Republic (ESN CZ) is a non-for-profit student organisation representing
            local ESN sections on the national level.
            Our mission is to foster student mobility in Higher Education under the principle of Students Helping Students.
            All together sections of ESN CZ (18 sections in total) help roughly 10 000 international students every academic year.
            ESN CZ represents international students, thus provide opportunities for cultural understanding and self-development.</p>
        <p><strong>Since March 2002, we are a proud member of the Erasmus Student Network.</strong></p>
        <img src="{{ asset('img/logos/esn-cz/esn-cz-logo-colour.svg') }}" alt="Logo ESN" title="Logo ESN" />
    </section>
@stop
