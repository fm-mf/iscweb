@extends('guide.layouts.subpage')

@section('title', 'Post office &ndash; ')

@section('subpage')
    <h1>Post office</h1>

    <p class="bg-danger">Unfortunately, most of the post office employees don't speak english, so be prepared when going to the post office.</p>
    
    <h2>Closest post office</h2>
    <h3>Masarykova Dorms</h3>
    <a href="https://goo.gl/maps/UVmjEk6pNm4hXFwWA" target="_blank"><address>Kafkova 19, Praha 6</address></a>
    <h3>Strahov Dorms</h3>
    <a href="https://goo.gl/maps/gAgXW3Rv88JfEepU8" target="_blank"><address>Vaníčkova 1911/5, 160 17 Břevnov-Strahov</address></a>

    <h2>Receiving packages</h2>
    <p>An invitation to pick up the shipment (&quot;Výzva k vyzvednutí zásilky&quot;) is a paper which is sent to you at your dorm (mailbox).</p>
    <p>It states when and at which post office you can pick up your package:</p>
    <p><img src="{{ asset('img/guide/vyzva-k-vyzvednuti-zasilky.jpg') }}" alt="An invitation to pick up the shipment" title="An invitation to pick up the shipment" /></p>

    <h2>How to send a postcard/a letter</h2>
    <p>Affix there a stamp marked &quot;E&quot; (CZK 32) for postage abroad. For postage inside the Czech Republic affix a stamp marked &quot;A&quot; (CZK 16).</p>
    <p>Find an orange post office letter box:</p>
    <p><img src="{{ asset('img/guide/post-office-letter-boxes.jpg') }}" title="Post office letter boxes" alt="Post office letter boxes" /></p>

    <p>You can find more information at <a href="https://www.ceskaposta.cz/en/index" target="_blank">www.ceskaposta.cz/en</a></p>
@stop