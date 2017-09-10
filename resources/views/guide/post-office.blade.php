@extends('layouts.guide.layout')

@section('title', 'Post office &ndash; ')

@section('content')
    <h1>Post office</h1>
    <dl>
        <dt>Closest post office</dt>
        <dd><address>Kafkova 19, Praha 6</address></dd>
        <dd>they don’t speak english anywhere</dd>
        <dt>Receiving packages</dt>
        <dd>An invitation to pick up the shipment (&quot;Výzva k vyzvednutí zásilky&quot;) is a paper which is sent to you at your dorm (mailbox)</dd>
        <dd>It states when and at which post office you can pick up your package</dd>
        <dd><img src="{{ asset('img/guide/vyzva-k-vyzvednuti-zasilky.jpg') }}" alt="An invitation to pick up the shipment" title="An invitation to pick up the shipment" /></dd>
        <dt>How to send a postcard/a letter</dt>
        <dd>Affix there a stamp marked &quot;E&quot; (CZK 32) for postage abroad. For postage inside the Czech Republic affix a stamp marked &quot;A&quot; (CZK 16)</dd>
        <dd>Find an orange post office letter box </dd>
        <dd><img src="{{ asset('img/guide/post-office-letter-boxes.jpg') }}" title="Post office letter boxes" alt="Post office letter boxes" /></dd>
    </dl>
    <p>Full information: <a href="https://www.ceskaposta.cz/en/index" target="_blank">www.ceskaposta.cz/en</a></p>
@stop