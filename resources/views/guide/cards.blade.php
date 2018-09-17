@extends('layouts.guide.layout')

@section('title', 'Cards &ndash; ')

@section('content')
    <h1>Cards</h1>
    <p>Without delay, obtain your University ID card purchase a Prague City public transportation card,
        and (for EU citizens) register for health care on the basis of your EHIC card</p>

    <h2>University ID card</h2>
    <p>There are two options, you can make your own choice.</p>

    <h3>CTU Student Identity Card</h3>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/cvut-student.jpg') }}" alt="CTU Student Identity Card" title="CTU Student Identity Card" /></li>
        <li><strong>Price: for free</strong>, in  the case of loss, a fee of CZK 200 is charged for a duplicate</li>
        <li><strong>Serves for:</strong>
            <ul>
                <li>Admission to CTU premises</li>
                <li>Borrowing books from university libraries</li>
                <li>Borrowing books from National Technical Library (for a fee)</li>
                <li>Discount card for CTU buffets and dining halls</li>
                <li>Confirmation of your student status (e.g. for a public transport season ticket and for discounts)</li>
            </ul>
        </li>
    </ul>

    <h3>International Student Identity Card with the CTU logo</h3>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/isic.jpg') }}" alt="International Student Identity Card with the CTU logo" title="International Student Identity Card with the CTU logo" /></li>
        <li><strong>Price: CZK 380</strong>, in  the case of loss, a fee of CZK 200 is charged for a duplicate</li>
        <li>Covers all services stated above</li>
        <li>In addition, serves as the only accepted international student identity card in 116 countries and offers many discounts (for further information visit <a href="https://www.isic.org" target="_blank">www.isic.org</a></li>
    </ul>

    <h3>Where to get it</h3>
    <p>Identity Card Publishing House</p>
    <dl>
        <dt>Address</dt>
             <dd><a href="https://goo.gl/maps/PcZMkQ6UZRn" target="_blank">Bechyňova 2571/3, Praha 6</a></dd>
        <dt>Phone</dt>
            <dd><a href="tel:+420 224 358 472">+420 224 358 472</a></dd>
            <dd><a href="tel:+420 224 358 471">+420 224 358 471</a></dd>
            <dd><a href="tel:+420 224 358 467">+420 224 358 467</a></dd>
        <dt>Opending hours</dt>
            <dd>Mo &ndash; Thu: 8:00 &ndash; 15:30</dd>
            <dd>Fr: 8:00 &ndash; 15:00</dd>
    </dl>
    <p>To avoid long queues you can register yourself for specific date and time via <a href="http://ke.customer.decent.cz/a021/obj/index.php?lang=en" target="_blank">the electronic reservation system</a>.</p>

    <h2 id="transportation-card">Public transportation card</h2>
    <p>You can buy a PID pass with a season paper ticket, buy a season paper ticket with your University ID card or buy a Lítačka electronic card.</p>
    <p><b>There will be a change in prices of long-term tickets. We recommend you to buy a one-month ticket now and then the one for a longer period. See the comparison table bellow for more information.</b></p>
    <h3>Single tickets</h3>
    <p>Before you get the card, a single tickets can be obtained at vending machines, at newsagents and tobacconists (<b>before</b> you get in the bus/tram/metro, also do not forget to <b>stamp it</b>)</p>
    <h3>PID pass + season paper ticket</h3>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/pid-pass-vs.jpg') }}" alt="PID pass" title="PID pass" /> + <img src="{{ asset('img/guide/season-paper-ticket-30-days.jpg') }}" alt="PID season ticket" title="PID season ticket" /></li>
        <li><strong>Price: CZK 20</strong> (for a PID pass) + <strong><a href="https://pid.cz/en/travelling-around-prague/?tab=2" target="_blank">season ticket price</a></strong></li>
    </ul>

    <table>
        <thead>
            <td>TICKET TYPE<br>ELECTRONIC/PAPER</td>
            <td>Fares until<br>1st of October</td>
            <td>Fares after<br>1st of October</td>
        </thead>
        <tbody>
            <tr>
                <td>monthly/30-days</td>
                <td>260 CZK</td>
                <td>130 CZK</td>
            </tr>
            <tr>
                <td>quarterly/90-days</td>
                <td>720 CZK</td>
                <td>360 CZK</td>
            </tr>
            <tr>
                <td>5-monthly/150-days</td>
                <td>1200 CZK</td>
                <td>canceled</td>
            </tr>
            <tr>
                <td>10-monthly/300-days</td>
                <td>2400 CZK</td>
                <td>canceled</td>
            </tr>
            <tr>
                <td>1-year/365-days</td>
                <td>-</td>
                <td>1280 CZK</td>
            </tr>
        </tbody>
    </table>

    <h3>Season paper ticket with your University ID card</h3>
    <p class="bg-info">Note: Only for students under the age of 26</p>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/season-paper-ticket-30-days.jpg') }}" alt="PID season ticket" title="PID season ticket" /> + University ID card</li>
        <li><strong>Price: <a href="https://pid.cz/en/travelling-around-prague/?tab=2" target="_blank">season ticket price</a></strong> + University ID card price</li>
    </ul>
    <p>You can get Season paper ticket to your University ID card</p>

    <h3>Lítačka electronic card</h3>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/litacka.jpg') }}" alt="Lítačka" title="Lítačka" /></li>
        <li><strong>Price: CZK 200</strong> (for &quot;Lítačka&quot;) + <strong><a href="https://pid.cz/en/travelling-around-prague/?tab=2" target="_blank">season ticket price</a></strong></li>
    </ul>

    <h3>Student discount</h3>
    <p>To obtain a student discount you have to bring, and keep all the time with you, the Confirmation of your student status (the little orange-coloured confirmation document from your Welcome Pack), or your University ID card.</p>

    <h2 id="ehic">Health insurance card (<abbr title="European Health Insurance Card">EHIC</abbr>)</h2>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/ehic.jpg') }}" alt="European Health Insurance Card" title="European Health Insurance Card" /></li>
        <li>EHIC (= European Health Insurance Card) is for students from the EU, Norway, Switzerland, Liechtenstein and Iceland</li>
        <li>Why: you <strong>have to</strong> show your EHIC card and a special paper from the VZP state insurance organisation to prove you have health insurance cover whenever you visit a doctor or any medical institution.</li>
        <li>Without this documentation, you have to pay for standard medical care in the Czech Republic and treatment may be refused to you</li>
        <li>How to get it: Visit and register in VZP (Všeobecná zdravotní pojišťovna České republiky) at Na Perštýně 6, Prague 1 to obtain an official document providing you the same health service as for local citizens</li>
        <li><strong>ISC will offer to take you to register during Orientation Week. It is important to register without delay.</strong></li>
        <li class="bg-info">Note: Students not from EU countries are required to have health insurance from an <strong>authorized insurance company</strong> and the original contract has to be written in the Czech language. You can, usually, arrange this online.</li>
    </ul>
@stop