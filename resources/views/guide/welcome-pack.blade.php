@extends('guide.layouts.subpage')

@section('subtitle', 'Welcome pack')

@section('subpage')
    <h2>Welcome pack</h2>
    <ul>
        <li>Before the Orientation Week starts you should get your Welcome Pack.</li>
        <li>
            You can ask your Buddy or you can get it in the <strong>ESN point</strong>,
            which is located in room R304 in Masarykova dormitory
            (Address: <a href="https://goo.gl/maps/tuJqTxMwnWy" target="_blank">Thákurova 550/1, Prague 6, 160 00</a>,
            Phone: <a href="tel:+420 233 051 111">+420 233 051 111</a>).
        </li>
    </ul>

    <h3>What is in the Welcome pack?</h3>
    <ul>
        <li>
            Materials from CTU
            <ul>
                <li>Dorm regulations</li>
                <li>Confirmation of study</li>
                <li>How to connect to Eduroam</li>
                <li>Health and safety regulations</li>
                <li>and much more</li>
            </ul>
        </li>
        <li>
            Materials from ESN
            <ul>
                {{-- <li>Printed Survival Guide</li> --}}
                <li>List of trips</li>
            </ul>
        </li>
        <li>Small gifts</li>
    </ul>

    <h3>How to get to the ESN Point?</h3>
    <ul>
        <li>From airport:
            <ol>
                <li>Take a trolleybus line <strong>59</strong> from Terminál 1 or Terminál 2 stop</li>
                <li>Go <strong>to Nádraží Veleslavín</strong> stop</li>
                <li>Go by <strong>metro</strong> line A (the green one) <strong>to Dejvická</strong> station</li>
                <li>or go by tram line <strong>20 or 26 to Thákurova</strong> stop</li>
            </ol>
        </li>
        <li>From Main train station:
            <ol>
                <li>Take tram line 26 from Hlavní nádraží stop</li>
                <li>Get off at Thákurova stop</li>
                <li>or take red metro line C (the red one) to Muzeum station</li>
                <li>where you have to transfer to green metro line A and go to Dejvická station</li>
            </ol>
        </li>
    </ul>

    <div class="alert alert-info mt-5">
        <p>
            Note: If you don’t buy a public transport pass immediately after your arrival,
            you need to buy and validate <strong>a single ticket for 90 minutes</strong>.
            You can buy the ticket from a ticket machine, or in application <a href="https://app.pidlitacka.cz" target="_blank">‘PID Lítačka’</a>
            (available for <a href="https://play.google.com/store/apps/details?id=cz.dpp.praguepublictransport&hl=en" target="_blank">Android</a>
            and <a href="https://itunes.apple.com/cz/app/pid-litacka/id983071129" target="_blank">iOS</a>).
        </p>
        <p class="mb-0">
            For current prices and further information, visit
            <a href="https://pid.cz/en/tickets-and-fare/#prague" target="_blank">pid.cz/en</a>.
        </p>
    </div>
@stop
