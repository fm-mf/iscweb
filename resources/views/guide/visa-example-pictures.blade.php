@extends('layouts.guide.layout')

@section('title', 'Visa example pictures &ndash; ')

@section('content')
    <h1>Visa example pictures</h1>
    <dl>
        <dt>&quot;C&quot; &ndash; Short-term visa</dt>
            <dd>Max 90 day-duration, can be extended</dd>
            <dd>Visit the Ministry of the Interior’s office, contact our <a href="mailto:visa@isc.cvut.cz">Visa Coordinator</a></dd>
            <dd><img src="{{ asset('img/guide/visa-c.jpg') }}" alt="Short-term visa &ndash; C" title="Short-term visa &ndash; C"></dd>
        <dt>&quot;D/VR&quot; &ndash; Entering visa</dt>
            <dd>Our consulate issued only a short term visa for you to get to the Czech Republic to receive the long-term residence permit.</dd>
            <dd>Visit the Ministry of the Interior’s office within 3 working days! (see <a href="{{ url('guide/visa#moi') }}">Ministry of the Interior’s Office</a>, very important)</dd>
            <dd>Contact our <a href="mailto:visa@isc.cvut.cz">Visa Coordinator</a></dd>
            <dd><img src="{{ asset('img/guide/visa-d-vr.jpg') }}" alt="Entering visa &ndash; D/VR" title="Entering visa &ndash; D/VR"></dd>
        <dt>&quot;D/VC&quot; &ndash; Long-term visa</dt>
            <dd>You are OK</dd>
            <dd>Just make sure that your reporting duty (Foreign Police Office) is covered (see <a href="{{ url('guide/visa#reporting') }}">Reporting duty</a>)</dd>
            <dd><img src="{{ asset('img/guide/visa-d-vc.jpg') }}" alt="Long-term visa &ndash; D/VC" title="Long-term visa &ndash; D/VC"></dd>
    </dl>
@stop