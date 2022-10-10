@extends('guide.layouts.subpage')

@section('subtitle', 'Funny facts')

@section('subpage')
    <h2>Funny facts</h2>
    <p><strong>10 exchange students' commandments</strong></p>
    <ol>
        <li>Learn how to do ISC fishing.</li>
        <li>Visit Scout Institute at least once a month</li>
        <li>Visit the Invisible Exhibition. Why? We don’t know but everyone does!</li>
        <li>Go to Klubovna once a week.</li>
        <li>Do not miss any Culture Evening!</li>
        {{--
        <li>Spend every other evening in bar downstairs in Masarykova</li>
        --}}
        <li>Try things you would never do home.</li>
        <li>Get a photo of yourself on the Red Couch in the ISC Point!</li>
        <li>Smile at Czechs!</li>
        <li>Do a Freedom run across Charles Bridge</li>
        <li>What happens on Erasmus, stays on Erasmus.</li>
    </ol>
    <img src="{{ asset('img/guide/do-did-done-meme.png') }}" alt="Do/did/done English vs. Czech meme" />
@stop
