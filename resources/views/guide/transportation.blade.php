@extends('guide.layouts.subpage')

@section('title', 'Transportation &ndash; ')

@section('subpage')
    <h1>Transportation</h1>

     @component('guide.section-nav', ['items' => [
        'prague' => [
            'title' => 'In Prague',
            'items' => [
                'day' => 'Day transport',
                'night' => 'Night transport',
                'ticket-inspection' => 'Ticket inspection'
            ]
        ],
        'other' => [
            'title' => 'Around the Czech Republic',
            'items' => [
                'student-discount' => 'Student discount',
                'bus-stations' => 'Main bus stations in Prague',
                'train-stations' => 'Important railway stations in Prague'
            ]
        ]
    ]])
    @endcomponent

    <h2 id="prague">In Prague</h2>
    <p>Prague has a very good public transport network including metro, trams, buses, Petřín funicular and ferries</p>
    <p>A connection finder, public transportation maps, ticket prices and a lot more you can find at <a href="https://pid.cz/en" target="_blank"><abbr title="Prague Integrated Transport (Pražská integrovaná doprava)">PID</abbr> website</a></p>
    <p>Get a season paper ticket with a PID pass or your University ID, or a &quot;Lítačka&quot; electronic transportation card (for more information see <a href="{{ url('guide/cards#transportation-card') }}">Cards</a>)</p>
    <p>Before you get your student travel card, single tickets can be obtained at vending machines, at newsagents and tobacconists (buy the ticket <strong>before</strong> you get on the bus/tram/metro)</p>
    <p class="bg-danger">Single tickets need to be validated in validator (at entrances to metro, or in buses and trams) in order to be valid.</p>
    <p>Most of the ticket vending machines accept only coins, only a few of them accept also payment cards</p>

    <h3 id="day">Day transport</h3>
    <ul>
        <li>Approximately from 5:00 to 24:00</li>
        <li>Three metro lines (A, B, C) and many bus and tram lines</li>
        <li>Trams have a one or two digit number, buses have a three digit number</li>
        <li>On weekdays during the rush hour metro runs every 2&ndash;3 minutes, trams run every 8 minutes and buses run every 6&ndash;10 minutes</li>
        <li>At weekends metro runs every 7&ndash;10 minutes, buses and trams run every 15&ndash;20 minutes</li>
    </ul>

    <h3 id="night">Night transport</h3>
    <ul>
        <li>Approximately from 0:00 to 5:00</li>
        <li>Only special night bus and tram lines operate during the night (trams 91&ndash;99, buses 901&ndash;915)</li>
        <li>All the night trams run every 30 minutes, some of the buses also run every 30 minutes, the rest of the buses run every 60 minutes</li>
        <li>At night there is a central interchange between all the night trams at Lazarská stop</li>
    </ul>

    <h3 id="ticket-inspection">Ticket inspection</h3>
    <p>If you are caught without a valid ticket, you will be required to pay a fine of CZK 1500, reduced to CZK 800 if it is paid on the spot or within 15 days.</p>
    <p>Always insist on getting a receipt. If you have left your valid pass at home, you pay a CZK 50 fine at Prague 2, Na Bojišti 5 (Metro Line C – I. P. Pavlova station) from the next day (12.30 pm) till the 15th day after (+showing your valid pass).</p>

    <h2 id="other">Around the Czech Republic</h2>
    <p>No need to rent a car, you can get almost everywhere by <strong>public transport</strong></p>
    <p>It is cheap, safe and the service network is dense</p>
    <p>Find your connection at <a href="http://www.idos.cz" target="_blank">idos.cz</a></p>

    <h3 id="student-discount">Student discount</h3>
    <p>As a student at a Czech university that is under 26 years old, you're eglible for <strong>75 % discount</strong> on any public transport within Czech Republic.</p>
    <p>
        You need to have a proof that you're czech student and <strong>only czech ISIC cards are universally accepted</strong> as proof,
        you can't use basic CTU card or your local ISIC card.
    </p>
    <p>
        If you don't have the ISIC card, the solution is specific for the public transport you indend to use.
        Some transport providers also provide other ways to identify, for example České Dráhy allow you to
        use their form of <a href="https://www.cd.cz/en/typy-jizdenek/vnitrostatni-jizdenky/-28466/">student card</a> (in the Terms and Conditions section).
    </p>

    <h3 id="bus-stations">Main bus stations in Prague</h3>
    <ul>
        <li>Florenc</li>
        <li>Černý Most</li>
        <li>Zličín</li>
    </ul>
    <p>Some international buses also depart from the Main railway station (Hlavní nádraží)</p>

    <h3 id="train-stations">Important railway stations in Prague</h3>
    <ul>
        <li>Hlavní nádraží (the Main railway station)</li>
        <li>Masarykovo nádraží (Masaryk railway station)</li>
    </ul>

@stop