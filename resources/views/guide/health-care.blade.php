@extends('guide.layouts.subpage')

@section('title', 'Health care &ndash; ')

@section('subpage')
    <h1>Health care</h1>

    @component('guide.section-nav', ['items' => [
        'ehic' => 'EHIC card',
        'urgent-care' => 'Urgent medical treatment',
        'standard-care' => 'Standard medical care',
        'pharmacies' => 'Pharmacies near the main campus',
        'prescriptions' => 'Prescriptions',
        'english-care' => [
            'title' => 'English speaking medical care',
            'items' => [
                'motol' => 'Motol University Hospital',
                'military' => 'Military University Hospital Prague &ndash; Střešovice',
                'polyclinic' => 'Městská poliklinika Praha',
                'student-center' => 'Student Health Centre'
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

    <h2 id="ehic">EHIC card</h2>
    <img src="{{ asset('img/guide/ehic.jpg') }}" />
    <p>For students from the EU it is necessary to have a European Health Insurance Card (EHIC) with confirmation from VZP (public health insurance system in CR).</p>
    <p>See &quot;<a href="{{ url('guide/cards#ehic') }}">Cards</a>&quot; to find how to get this confirmation.</p>

    <h2 id="urgent-care">Urgent medical treatment</h2>
    <ul>
        <li>CZK 90 extra fee</li>
        <li>when you go to the hospital in &quot;ambulance hours&quot; (&quot;Pohotovost/Ambulance&quot;) (different for each hospital) </li>
    </ul>

    <h2 id="standard-care">Standard medical care</h2>
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

    <h2 id="pharmacies">Pharmacies near the main campus</h2>
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

    <h2 id="prescriptions">Prescriptions</h2>
    <ul>
        <li>Issued through the doctor</li>
        <li>Dispensed by any pharmacy</li>
        <li>ou can be asked to pay a share of costs</li>
        <li>Some medicines that you can get over-the-counter in your country may be sold only on prescription here</li>
    </ul>

    <h2 id="english-care">English speaking medical care</h2>
    <p>In case of emergency call <strong><a href="tel:112">112</a></strong></p>

    <h3 id="motol">Motol University Hospital</h3>
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
        <li><a href="https://www.fnmotol.cz/en/samoplatci/health-care-services-for-foreigners/" target="_blank">www.fnmotol.cz/en/samoplatci/health-care-services-for-foreigners/</a></li>
    </ul>

    <h3 id="military">Military University Hospital Prague &ndash; Střešovice</h3>
    <ul>
        <li>Information desk (24/7, English speaking): <a href="tel:+420 973 208 333">+420 973 208 333</a> (they will direct you to the right person)</li>
        <li><address>U Vojenské nemocnice 1200, Praha 6</address></li>
        <li>Includes also <strong>ambulance</strong></li>
        <li><a href="https://www.uvn.cz/index.php?option=com_content&view=article&id=5082&Itemid=2032&lang=en" target="_blank">Military University Hospital Prague website</a></li>
    </ul>

    <h3 id="polyclinic">Městská poliklinika Praha</h3>
    <ul>
        <li><address>Spálená 12, Praha 1</address></li>
        <li><a href="tel:+420 222 924 211">+420 222 924 211</a></li>
        <li>For students, contract with CTU</li>
        <li>Most of the doctors are English-speaking. For contacts and office hours see <a hre="http://www.prahamp.cz/index.php?oid=1262545" target="_blank">their website (only in CZ -> ask your buddy to help you with translation)</a></li>
    </ul>

    <h3 id='student-center'>Student Health Centre</h3>
    <ul>
        <li>Bechyňova 3, Praha 6, 2nd floor</li>
        <li>
            <dl>
                <dt>MUDr. Sadílková</dt>
                <dd><a href="tel:+420 212 243 144">+420 212 243 144</a></dd>
                <dd>room 411</dd>
                <dd>Mon, Wed: 8-15</dd>
                <dd>Tue: 12-18</dd>
                <dd>Thu: 8-12</dd>
                <dd>Fri: 8-14</dd>
                <dt>MUDr. Jitka Adámková</dt>
                <dd><a href="tel:+420 234 606 163">+420 234 606 163</a></dd>
                <dd>room 431</dd>
                <dt>MUDr. Šulcová &ndash; dentist</dt>
                <dd><a href="tel:+420 233 320 229">+420 233 320 229</a></dd>
                <dd>Mon: 8:00-16:00</dd>
                <dd>Tue: 8:00 - 18:00</dd>
                <dd>Wed, Thu: 8:00 - 14:00</dd>
                <dd>Fri: 8:00 - 13:00</dd>
            </dl>
        </li>
    </ul>

    <h2 id="vocab">Helpful vocab</h2>
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