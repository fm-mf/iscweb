@extends('guide.layouts.subpage')

@section('subtitle', 'Transportation')

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
    <p>
        Prague has a very good public transport network including metro, trams, buses, Petřín funicular and ferries.
    </p>
    <p>
        A connection finder, public transportation maps, ticket prices and a lot more information
        you can find at <a href="https://pid.cz/en" target="_blank"><abbr title="Prague Integrated Transport (Pražská integrovaná doprava)">PID</abbr> website</a>
    </p>
    <p>
        Get a season paper ticket with a PID pass or your University ID,
        or a ‘Lítačka’ electronic transportation card
        (for more information see <a href="{{ url('guide/cards#transportation-card') }}">Cards</a>).
        You can also buy an electronic season ticket in application <a href="https://app.pidlitacka.cz" target="_blank">‘PID Lítačka’</a>
        (available for <a href="https://play.google.com/store/apps/details?id=cz.dpp.praguepublictransport&hl=en" target="_blank">Android</a>
        and <a href="https://itunes.apple.com/cz/app/pid-litacka/id983071129" target="_blank">iOS</a>).
    </p>
    <p>
        Before you get your student travel card, single tickets can be obtained at vending machines,
        at newsagents and tobacconists (buy the ticket <strong>before</strong> you get on the bus/tram/metro),
        or in ‘PID Lítačka’ app.
    </p>
    <p class="bg-danger">
        Single tickets need to be validated in validator (at entrances to metro, or in buses and trams)
        in order to be valid. In cas of the single tickets bought in the ‘PID Lítačka’ app,
        they have to be activated at least 2 minutes before entering the public transport vehicle / metro station.
    </p>
    <p>All of the ticket vending machines accept coins, but many of them accept also payment (debit/credit) cards.</p>

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
    <p>If you are caught without a valid ticket, you will be required to pay a fine of CZK 1500, reduced to CZK 1000 if it is paid on the spot or within 15 days.</p>
    <p>Always insist on getting a receipt. If you have left your valid pass at home, you pay only a CZK 50 fine at Prague 2, Na Bojišti 5 (Metro Line C – I. P. Pavlova station) from the next day (12.30 pm) till the 15th day after (if you show your valid pass).</p>

    <h2 id="other">Around the Czech Republic</h2>
    <p>No need to rent a car, you can get almost everywhere by <strong>public transport</strong></p>
    <p>It is cheap, safe and the service network is dense</p>
    <p>Find your connection at <a href="https://www.idos.cz/en" target="_blank">IDOS.cz</a></p>

    <h3 id="student-discount">Student discount</h3>
    <p>
        As a student of any university in the world who is under 26 years old,
        you're eligible for a <strong>75% discount</strong> on any public transport within the Czech Republic.
    </p>
    <p>
        You need to have a proof that you are a student. You can use a valid ISIC card
        (either the CTU one or from your home university), or a Czech student transportation card.
        The basic CTU ID card is not accepted.
        <img src="{{ asset('img/guide/isic-zakovsky-prukaz.jpg') }}" alt="ISIC & Student transportation card" />
    </p>
    <p>
        The discount mentioned above is applicable only for traveling between cities of the Czech Republic.
        When traveling within a city, each city has its own rules for discounts on public transport.
        If you want to be almost certain to have the student discount on public transport, then the CTU ISIC is recommended.
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
