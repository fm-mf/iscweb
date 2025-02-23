@extends('guide.layouts.subpage')

@section('subtitle', 'Health care')

@section('subpage')
    <h2>Health care</h2>

    @component('guide.components.section-nav', ['items' => [
        'ehic' => 'EHIC card',
        'urgent-care' => 'Urgent medical treatment',
        'standard-care' => 'Standard medical care',
        'hiv' => 'HIV+',
        'pharmacies' => 'Pharmacies near the main campus',
        'prescriptions' => 'Prescriptions',
        'english-care' => [
            'title' => 'English speaking medical care',
            'items' => [
                'motol' => 'Motol University Hospital',
                'military' => 'Military University Hospital Prague &ndash; Střešovice',
                'doctor-prague' => 'Health centre Prague',
            ]
        ],
        'vocab' => 'Helpful vocab'
    ]])
    @endcomponent

    <ul>
        <li>International students normally have quite good experience with the ordinary public Czech health care services.</li>
        <li>Usually there is no need to visit a private practice and pay extra for it</li>
        <li>Please inform the <a href="{{ url('guide/campus#ctu-international-office') }}">International Office</a> (or your <a href="{{ url('guide/campus#faculty-contacts') }}">faculty contact person</a>) about any health condition that should be notified (e.g. diabetes).</li>
    </ul>

    <h3 id="ehic">EHIC card</h3>
    <img src="{{ asset('img/guide/ehic.jpg') }}" alt="European health insurance card" />
    <p>For students from the EU it is necessary to have a European Health Insurance Card (EHIC) with confirmation from VZP (public health insurance system in CR).</p>
    <p>See &quot;<a href="{{ url('guide/cards#ehic') }}">Cards</a>&quot; to find how to get this confirmation.</p>

    <h3 id="urgent-care">Urgent medical treatment</h3>
    <ul>
        <li>CZK 90 extra fee</li>
        <li>when you go to the hospital in &quot;ambulance hours&quot; (&quot;Pohotovost/Ambulance&quot;) (different for each hospital) </li>
    </ul>

    <h3 id="standard-care">Standard medical care</h3>
    <ul>
        <li>must be paid on the spot</li>
        <li>bring cash with you (especially dentists’ treatments are really expensive)</li>
        <li>EHIC card with the confirmation paper covers basic treatments (See &quot;<a href="{{ url('guide/cards#ehic') }}">Cards</a>&quot; to find how to get it)
            <ul>
                <li>Double check that the doctor has a contract with VZP (public health insurance system in CR)</li>
                <li><a href="https://www.kancelarzp.cz/en" target="_blank">www.kancelarzp.cz/en </a> </li>
            </ul>
        </li>
        <li>Students from non-EU countries
            <ul>
                <li>required to have health insurance from an authorized insurance company licensed to operate in the Czech Republic</li>
                <li>The original contract has to be written in Czech language (or you have to obtain a certified translation into Czech language).</li>
            </ul>
        </li>
    </ul>

    <h3 id="hiv">HIV+</h3>
    <p>
        If you are HIV+ this is how you can take your medication and make your check up in Prague for free.
        If you don't want to waste your time, follow the next instructions.
    </p>
    <b>Have with you:</b>
    <ul>
        <li>Your Czech medical insurance</li>
        <li>Your Czech student card</li>
        <li>An English certification from your home hospital that declare you are HIV+ and the kind of medication you take</li>
        <li>History of your blood tests (always from your home hospital)</li>
    </ul>
    <b>The hospital area is in Prague 8, there are many specialized pavilions, you have to go for "infectious diseases":</b>
    <ul>
        <li>Go to Pavilion 7, you can find on Google map: Budova 7 - Klinika infekčních, parazitárních a tropických nemocí - Nemocnice Na Bulovce</li>
        <li>After that you will talk with a doctor, the nurse will record you in the system</li>
        <li>They will release you a paper that you will bring to the closing pharmacy (pavilion 1)</li>
        <li>You can find the pharmacy on Google maps: Ústavní lékárna Bulovka.</li>
        <li>Address: Budínova 3, 180 00 Praha 8, Cechia.</li>
        <li>Take your drugs and can come back to your room :)</li>
    </ul>
    <b>For other time:</b>
    <p>
        After the first time,  just take with you your Czech Insurance (no more), you have to go every month to take your drugs
        (while Czech people can go every 3 months) and the doctor will decide also when you will take your blood tests.
    </p>
    <b>When:</b>
    <p>Monday to Friday - 8:00 to 13:00</p>
    <p>
        (The first time go before than 10:30/11:00 because you have to find the HIV department inside the building 7,
        and you have also to talk with a doctor who will not stay there all the morning.
        The doctors can speak English, the nurse cannot or not very well).
    </p>
    <b>FOR FAST RECAPPING:</b>
    <ul>
        <li>Pavilion 7: Klinika infekčních</li>
        <li>Pavilion 1: Ústavní lékárna Bulovka</li>
    </ul>
    <p>
        NOTE 1: In this hospital you can book for free also tests for other STDs (like Syphilis, Clamidia, Gonorrhea, etc),
        you can ask to the nurse to book a visit with a dermatologist. For the tests you will go to Pavilion 9: dermatovenereology.
    </p>
    <p>
        NOTE 2: if you will go by public transport, the closest tram station is BULOVKA.
    </p>
    <p>
        This is the faster way to reach BULOVKA tram station:
    </p>
    <ul>
        <li>Take the green metro A, get off in FLORA.</li>
        <li>Exit (Směr): Ohrada - Palmovka</li>
        <li>As you go out, you can wait there the tram n° 10 to Bulovka.</li>
    </ul>
    <p>NOTE 3: Use the condom and enjoy Prague!</p>
    <p>Thank you, Alex, for this info</p>

    <h3 id="pharmacies">Pharmacies near the main campus</h3>
    <dl>
        <dt>Dr. Max</dt>
        <dd>Vítězné nám. 13, Praha 6</dd>
        <dd><strong>nonstop</strong></dd>
        <dt>Benu</dt>
        <dd>Vítězné nám. 9, Praha 6</dd>
        <dd>Mon - Fri: 7:30 - 18:00</dd>
        <dd>Sat: 8:00 - 14:00</dd>
        <dt>Dejvická Lékárna</dt>
        <dd>Dejvická 29, Praha 6</dd>
        <dd>Mon - Fri: 7:30 - 18:30</dd>
        <dd>Sat: 8:00 - 12:00</dd>
        <dt>Pharmacy Student House</dt>
        <dd>Bechyňova 3, Praha 6</dd>
        <dd>Mon - Fri: 8:00 - 16:00</dd>
        <dt>Dr. Max</dt>
        <dd>Jugoslávských partyzánů 20, Praha 6</dd>
        <dd>Mon - Fri: 8:00 - 18:30</dd>
    </dl>

    <h3 id="prescriptions">Prescriptions</h3>
    <ul>
        <li>Issued through the doctor</li>
        <li>Dispensed by any pharmacy</li>
        <li>ou can be asked to pay a share of costs</li>
        <li>Some medicines that you can get over-the-counter in your country may be sold only on prescription here</li>
    </ul>

    <h3 id="english-care">English speaking medical care</h3>
    <p>In case of emergency call <strong><a href="tel:112">112</a></strong></p>

    <h4 id="motol">Motol University Hospital</h4>
    <ul>
        <li><strong>Ambulance</strong></li>
        <li>English speaking centre for foreigners (&quot;Cizinecká ambulance&quot;)</li>
        <li>Phone: <a href="tel:+420 224 438 577">+420 224 438 577</a></li>
        <li>Address: <address>V Úvalu 84, Praha 5</address></li>
        <li>You can make an appointment (in order not to spend hours waiting there)</li>
        <li>Office hours
            <dl>
                <dt>Mon, Tue, Thu</dt>
                <dd>9:00 -16.30</dd>
                <dt>Wed</dt>
                <dd>7:30 - 15:00</dd>
                <dt>Fri</dt>
                <dd>9:00 - 14:00</dd>
            </dl>
        </li>
        <li><a href="https://www.fnmotol.cz/en/oddeleni-pece-o-samoplatce/" target="_blank">www.fnmotol.cz/en/oddeleni-pece-o-samoplatce/</a></li>
    </ul>

    <h4 id="military">Military University Hospital Prague &ndash; Střešovice</h4>
    <ul>
        <li>Information desk (24/7, English speaking): <a href="tel:+420 973 208 333">+420 973 208 333</a> (they will direct you to the right person)</li>
        <li><address>U Vojenské nemocnice 1200, Praha 6</address></li>
        <li>Includes also <strong>ambulance</strong></li>
        <li><a href="https://www.uvn.cz/index.php?option=com_content&view=article&id=5082&Itemid=2032&lang=en" target="_blank">Military University Hospital Prague website</a></li>
    </ul>

    <h4 id="doctor-prague">Doctor Prague – Health center Prague</h4>
    <ul>
        <li><address><a href="https://goo.gl/maps/MeFhx2QiSNAni2zU8" target="_blank" rel="noopener">Vodičkova 699/28, Praha 1 – Nové Město</a></address></li>
        <li>Appointments: <a href="tel:+420 224 220 040">+420 224 220 040</a> (Mo–Fri 8:30–17:00)</li>
        <li>24-hour phones:
            <ul>
                <li><a href="tel:+420 603 433 833">+420 603 433 833</a></li>
                <li><a href="tel:+420 603 481 361">+420 603 481 361</a></li>
            </ul>
        </li>
        <li>All doctors speak English and many also speak some other foreign language</li>
        <li>For more details visit <a href="http://doctor-prague.cz/" target="_blank" rel="noopener">their website</a></li>
    </ul>

    <h3 id="vocab">Helpful vocab</h3>
    <dl>
        <dt>Ache/pain</dt>
        <dd>Bolest</dd>
        <dt>Allergy</dt>
        <dd>alergie</dd>
        <dt>Bleeding</dt>
        <dd>krvácení</dd>
        <dt>Broken</dt>
        <dd>zlomený</dd>
        <dt>Burn</dt>
        <dd>popálení</dd>
        <dt>Constipation</dt>
        <dd>nadýmání</dd>
        <dt>Cramps</dt>
        <dd>křeče</dd>
        <dt>Cough</dt>
        <dd>kašel</dd>
        <dt>Diarrhea</dt>
        <dd>průjem</dd>
        <dt>Dizziness</dt>
        <dd>závrať</dd>
        <dt>Fever</dt>
        <dd>horečka</dd>
        <dt>Injury</dt>
        <dd>úraz</dd>
        <dt>Nausea</dt>
        <dd>nevolnost</dd>
        <dt>Poisoning</dt>
        <dd>otrava</dd>
        <dt>Painful</dt>
        <dd>bolestivý</dd>
        <dt>Rash</dt>
        <dd>vyrážka</dd>
        <dt>Shock</dt>
        <dd>šok</dd>
        <dt>Sneezing</dt>
        <dd>kýchání</dd>
        <dt>Sunstroke</dt>
        <dd>úžeh/úpal</dd>
        <dt>Unconsciousness</dt>
        <dd>bezvědomí</dd>
        <dt>Vomiting</dt>
        <dd>zvracení</dd>
    </dl>

@stop
