<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>No Buddy for you</title>
    </head>
    <body>
        <p>Hi {{ $exchangeStudent->person->first_name }},</p>
        <p>
            your arrival is approaching (or you have already arrived) and even though we try to do our best,
            unfortunately, we can not find a Buddy for every exchange student. Buddy program is a voluntary
            service and the number of exchange students coming every semester is very high.
            We keep you in the Buddy database so someone can still become your Buddy.
        </p>
        <p>
            Our <a href="{{ route('guide') }}" target="_blank">Survival Guide</a>
            on our web site gives you all the information and dates needed for the first days of your stay in Prague.
        </p>
        <p>
            <a href="{{ route('guide-page', ['page' => 'welcome-pack']) }}" target="_blank">Welcome Packs</a>
            are prepared for you in our <a href="https://goo.gl/maps/MrjEDKdCTUm" target="_blank">ISC Point</a>
            at Masarykova dormitory – it is very useful because it includes a confirmation of study
            (needed for student discount in Prague public transport), info about registration
            at your new faculty, orientation week etc. Be sure to pick it up.
            <strong>The Welcome Pack is waiting for you at Masarykova dormitory, room R304, 3rd floor (ISC Point).
            Check <a href="{{ route('web.contacts') }}" target="_blank">our website</a> for opening hours.</strong>
        </p>
        <p><strong>What do you need to do after your arrival:</strong></p>
        <ol>
            <li>
                <strong>Do not change money at the airport.</strong>
                It is not favourable. As much as we know, the best exchange agency is eXchange
                <a href="https://goo.gl/maps/buXiGkPoo3q" target="_blank"> near Staroměstské náměstí</a>
                with a coupon for even better exchange rate available
                <a href="https://www.exchange.cz/kupon" target="_blank">here</a>.
            </li>
            <li>How to get from the airport to Dejvice (where main CTU campus and Masarykova dormitory is):
                <ul>
                    <li>
                        You can find a little shop with a big sign ‘Public Transport’ at both terminals.
                        Go there and buy a <strong>90-minute ticket</strong>. It is valid for 90 minutes since you validate it on the bus.
                        That is enough for your way.
                    </li>
                    <li>
                        Another option is to buy the ticket from a ticket machine at the airport terminal or at the bus stop.
                        The ticket machines accepts credit/debit cards.
                    </li>
                    <li>
                        You can also buy the ticket in the <a href="https://app.pidlitacka.cz">‘PID Lítačka’ app</a> on your phone
                        (available for <a href="https://play.google.com/store/apps/details?id=cz.dpp.praguepublictransport&hl=en" target="_blank">Android</a>
                        and <a href="https://itunes.apple.com/cz/app/pid-litacka/id983071129" target="_blank">iOS</a>)
                        – install the app, register a new account, buy the ticket with a credit/debit card,
                        activate ticket before you get in the bus. You need a working internet connection for this though.
                    </li>
                    <li>
                        Find a stop of <strong>bus No. 119</strong> (in front of both terminals). When you enter the bus,
                        don’t forget to validate the ticket in a yellow validation box inside the bus.
                    </li>
                    <li>
                        Go to the terminal station ‘<strong>Nádraží Veleslavín</strong>’ and change to the metro line A (green)
                        in the direction of ‘Depo Hostivař’. Go to the station ‘<strong>Dejvická</strong>’.
                    </li>
                </ul>
            </li>
            <li>Go to the <a href="https://goo.gl/maps/uAb8pHV6kkWvjSXDA" target="_blank">Masarykova dormitory</a> to the 3rd floor to ISC Point and get:
                <ul>
                    <li><a href="{{ route('guide-page', ['page' => 'welcome-pack']) }}">Welcome pack</a></li>
                    <li><a href="{{ route('guide-page', ['page' => 'isc-intro#membership']) }}">ISC membership</a> (optional) with ESNcard &amp; SIM card &amp; T-shirt</li>
                </ul>
            </li>
            <li>Go to the metro station Hradčanská or Nádraží Veleslavín and get:
                <ul>
                    <li>
                        1-month or 3-months student public transport pass (don’t forget
                        the confirmation of study from your Welcome Pack
                        and a passport-sized photo (35×45 mm))
                    </li>
                </ul>
            </li>
            <li>Go to the <a href="https://ist.cvut.cz/en/our-services/ctu-student-cards/" target="_blank">CTU Identity Publishing House (VIC)</a> and get:
                <ul>
                    <li>
                        <a href="{{ route('guide-page', ['page' => 'cards']) }}">University ID card</a> and
                        <a href="{{ route('guide-page', ['page' => 'kos']) }}">Login for the Study information system – KOS</a>
                        (check since when it is possible to get those in the printed Survival Guide form the Welcome pack)
                    </li>
                </ul>
            </li>
        </ol>
        <p>In case you have any questions or difficulties, don’t hesitate to contact us!</p>
        <p>Your ISC CTU in Prague</p>
    </body>
</html>
