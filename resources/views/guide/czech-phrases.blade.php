@extends('guide.layouts.subpage')

@section('subtitle', 'Czech phrases')

@section('subpage')
    <h2>Czech phrases</h2>
    <dl>
        <dt>Yes</dt>
            <dd>Ano</dd>
            <dd>ano</dd>
        <dt>No</dt>
            <dd>Ne</dd>
            <dd>ne</dd>
        <dt>Please</dt>
            <dd>Prosím</dd>
            <dd>proseem</dd>
        <dt>Thank you</dt>
            <dd>Děkuji vám</dd>
            <dd>dyekooyi vam</dd>
        <dt>Good morning</dt>
            <dd>Dobré ráno</dd>
            <dd>dobrye rano</dd>
        <dt>Good afternoon</dt>
            <dd>Dobré odpolende</dd>
            <dd>dobrye odpoledne</dd>
        <dt>Good night</dt>
            <dd>Doubrou noc</dd>
            <dd>dobroh nots</dd>
        <dt>Hello</dt>
            <dd>Dobrý den</dd>
            <dd>dobree den</dd>
        <dt>Goodbye</dt>
            <dd>Na shledanou</dd>
            <dd>nas-khledanow</dd>
        <dt>What is your name?</dt>
            <dd>Jak se jemnujete?</dd>
            <dd>yak se menooyete</dd>
        <dt>My name is ...</dt>
            <dd>Jmenuji se ...</dd>
            <dd>menooyi se</dd>
        <dt>I don't understand</dt>
            <dd>Nerozumím</dd>
            <dd>nerozoomeem</dd>
        <dt>I'll have a beer, please.</dt>
            <dd>Dám si jedno pivo, prosím.</dd>
            <dd>dam si yedno pivo, proseem</dd>
        <dt>Would you like to dance?</dt>
            <dd>Smím prosit?</dd>
            <dd>smeem prossit</dd>
        <dt>I can't live without you.</dt>
            <dd>Nemůžu bez tebe žít.</dd>
            <dd>nemoozhu bes tebe zheet</dd>
        <dt>The check, please.</dt>
            <dd>Platit, prosím.</dd>
            <dd>platyit, proseem</dd>
        <dt>Attention!</dt>
            <dd>Pozor!</dd>
            <dd>pozor</dd>
    </dl>
    <p><a href="{{ route('web.activities.languages') }}" target="_blank">Visit our free language courses.</a></p>
@stop
