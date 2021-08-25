@extends('guide.layouts.subpage')

@section('subtitle', 'Cards')

@section('subpage')
    <h1>Cards</h1>

    @component('guide.section-nav', ['items' => [
        'university-id' => [
            'title' => 'University ID card',
            'items' => [
                'ctu-id' => 'CTU Student Identity Card',
                'ctu-isic-id' => 'International Student Identity Card with the CTU logo',
                'where-to-get-ctu-id' => 'Where to get it'
            ]
        ],
        'transportation-card' => [
            'title' => 'Public transportation card',
            'items' => [
                'pid-paper-pass' => 'PID pass + season paper ticket',
                'student-pid-paper-pass' => 'Season paper ticket with your University ID card',
                'litacka' => 'Lítačka electronic card',
                'pid-student-discount' => 'Student discount'
            ]
        ],
        'ehic' => 'Health insurance card'
    ]])
    @endcomponent

    <p>
        Once you arrive, you should obtain following cards:
        <ul>
            <li><a href="#university-id">University ID</a>
                <ul>
                    <li>Allows access to university buildings, library, cafiteria and more</li>
                </ul>
            </li>
            <li><a href="#transportation-card">Prague City public transportation card</a>
                <ul>
                    <li>Public transport is essential in Prague and you get a big discount as a student</li>
                </ul>
            </li>
            <li><a href="#ehic">(for EU citizens) Register for health care on the basis of your EHIC card</a>
                <ul>
                    <li>Required if you want to use your european insurance</li>
                </ul>
            </li>
        </ul>
    </p>

    <h2 id="university-id">University ID card</h2>
    <p>For your University ID card, you can choose from two options:</p>

    <ul>
        <li><a href="#ctu-id">CTU Student Identity Card</a>
        <ul>
            <li>Basic CTU card, works for anything CTU related</li>
            <li>Free, but not universally accepted</li>
        </ul>
        </li>
        <li><a href="#ctu-isic-id">International Student Identity Card with the CTU logo</a>
        <ul>
            <li>Works same as CTU Student Identity Card</li>
            <li>Costs CZK 380, but is more widely accepted</li>
            <li>Easier to identify as <a href="{{ url('guide/transportation#student-discount') }}">student in trains</a>
        </ul>
        </li>
    </ul>

    <h3 id="ctu-id">CTU Student Identity Card</h3>
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

    <h3 id="ctu-isic-id">International Student Identity Card with the CTU logo</h3>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/isic.jpg') }}" alt="International Student Identity Card with the CTU logo" title="International Student Identity Card with the CTU logo" /></li>
        <li><strong>Price: CZK 380</strong>, in  the case of loss, a fee of CZK 200 is charged for a duplicate</li>
        <li>Covers all services stated above</li>
        <li>In addition, serves as the only accepted international student identity card in 116 countries and offers many discounts (for further information visit <a href="https://www.isic.org" target="_blank">www.isic.org</a></li>
    </ul>

    <h3 id="where-to-get-ctu-id">Where to get it</h3>
    <p>Identity Card Publishing House</p>
    <p class="bg-warning">Your personal visit is necessary!</p>
    <p class="bg-info">Bring with you your ID or passport, and a passport-sized photo.</p>
    <dl>
        <dt>Webpage</dt>
            <dd><a href="https://ist.cvut.cz/en/our-services/category-of-services/id-cards/" target="_blank">ist.cvut.cz</a></dd>
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
    <p>When you're buying seasonal Prague public transport ticket, you have multiple choices how to do it:</p>

    <ul>
        <li><a href="#pid-paper">Paper version</a>
            <ul>
                <li>Can be done at the airport, you don't need to have czech ISIC card</li>
            </ul>
        </li>
        <li><a href="#pid-electro">Electronic version</a>
            <ul>
                <li>Easier if you already have your czech ISIC card</li>
            </ul>
        </li>
        <li><a href="#litacka">Lítačka card</a></li>
    </ul>

    <h3 id="pid-paper">Paper version</h3>

    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/pid-pass-vs.jpg') }}" alt="PID pass" title="PID pass" /> + <img src="{{ asset('img/guide/season-paper-ticket-30-days.jpg') }}" alt="PID season ticket" title="PID season ticket" /></li>
        <li><strong>Price: CZK 20</strong> (for a PID pass) + <strong><a href="https://pid.cz/en/travelling-around-prague/?tab=2" target="_blank">season ticket price</a></strong></li>
    </ul>

    <p>This is the easiest version, because you can do it right at the airport with the Confirmation of study which is part of your Welcome Pack. It costs CZK 20 (for the ID) and you'll need:</p>
    <ul>
        <li>Passport photo</li>
        <li>Confirmation of study (part of <a href="/guide/welcome-pack">Welcome Pack</a>) <strong>OR</strong> student ID card (both types are valid for this case)
            <ul>
                <li>If you're 26 or older, you're no longer eglible for student discount, so this is not needed</li>
            </ul>
        </li>
    </ul>
    <p>Then you can just come to any <a href="https://pid.cz/en/contacts/points-of-sale/?type=2">PID cash desk</a> and ask them for student seasonal ticket. </p>

    <h3 id="pid-electro">Electronic version</h3>
    <p><strong>Price:</strong> only <a href="https://pid.cz/en/travelling-around-prague/?tab=2" target="_blank">season ticket price</a></p>

    <p>You can also obtain electronic seasonal ticket on the web.</p>
    <ol>
        <li>Create an account at <a href="https://www.pidlitacka.cz/home">www.pidlitacka.cz</a></li>
        <li>Upload your photo
            <ul>
                <li>If you don't do this, your account will be marked as "shared" and the ticket will be more expensive</li>
            </ul>
        </li>
        <li>Add an identifier - it can be your phone, debit/credit card or <a href="#litacka">Lítačka</a></li>
        <li>Add your ISIC card
            <ul>
                <li>If you only have CTU card or confirmation of study, you can't use the online store to buy the ticket, you have to go to <a href="https://pid.cz/en/contacts/points-of-sale/?type=2">PID cash desk</a></li>
                <li>If you're 26 or older, you're no longer eglible for student discount, so this is not needed</li>
            </ul>
        </li>
        <li>Buy student season ticket
            <ul>
                <li>If you can't find student seasonal ticket in the store, you may need to go to <a href="https://pid.cz/en/contacts/points-of-sale/?type=2">PID cash desk</a> and buy it there (while presenting your ISIC card and identifier from previous step)</li>
            </ul>
        </li>
    </ol>

    <h3 id="litacka">Lítačka card</h3>
    <ul class="list-unstyled">
        <li><img src="{{ asset('img/guide/litacka.jpg') }}" alt="Lítačka" title="Lítačka" /></li>
        <li><strong>Price: CZK 200</strong> (for &quot;Lítačka&quot;) + <strong><a href="https://pid.cz/en/travelling-around-prague/?tab=2" target="_blank">season ticket price</a></strong></li>
    </ul>

    <p>You can also obtain Lítačka card, which takes around 2 weeks to be made and costs CZK 200. Once you have this card,  you can either buy the seasonal ticket online, or go to any <a href="https://pid.cz/en/contacts/points-of-sale/?type=2">PID cash desk</a> and but it there.</p>

    <h3 id="pid-student-discount">Student discount</h3>
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
