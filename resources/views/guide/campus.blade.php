@extends('guide.layouts.subpage')

@section('title', 'Campus &ndash; ')

@section('subpage')
    <h1>Campus</h1>

     @component('guide.section-nav', ['items' => [
        'main-campus' => 'The main Campus',
        'satellite-campuses' => [
            'title' => 'The satellite Campuses',
            'items' => [
                'locations' => 'Locations'
            ]
        ],
        'important-contacts' => [
            'title' => 'Important contacts &amp; addresses',
            'items' => [
                'ctu-international-office' => 'CTU International Office',
                'faculty-contacts' => 'Faculties, Institutes &amp; Contact persons'
            ]
        ]
    ]])
    @endcomponent

    <p>The Czech Technical University has several sites around Prague. The main Campus is in Dejvice,
        where the Student administration and most of the faculties are located,
        there are some smaller buildings dotted around Prague and Kladno.</p>

    <h2 id="main-campus">The main Campus</h2>
    <ul class="list-unstyled">
        <li>Located in the north western suburbs of Prague, next to Dejvická metro station, see the area on the map below</li>
        <li>The offices of the CTU rectorate (including the International Office) as well as the faculties of Civil, Mechanical and Electrical Engineering, the Faculty of Information Technology, the Faculty of Architecture and Masaryk Institute of Advanced Studies</li>
        <li>National Technical Library, several of the dormitories, the Student house (Student IDs, Canteen, etc.) and the ISC Point</li>
        <li><a href="{{ asset('img/guide/map-ctu-campus-dejvice-2017.png') }}" target="_blank"><img src="{{ asset('img/guide/map-ctu-campus-dejvice-2017.png') }}" alt="Map of the CTU main campus in Dejvice" title="Map of the CTU main campus in Dejvice" /></a></li>
    </ul>

    <h2 id="satellite-campuses">The satellite Campuses</h2>
    <ul>
        <li>Finding your classroom can be difficult when everything is not on one spot</li>
        <li>See the <a href="#important-contacts">Important contacts</a> - faculty contacts, <strong>links</strong> to pages with maps of satellite campuses as well as an explanation of the room numbering</li>
        <li>You can also find the map in the Welcome Pack or at the <a href="https://www.cvut.cz/en/ctu-map" target="_blank">CTU website</a></li>
    </ul>

    <h3 id="locations">Locations</h3>
    <dl class="contactsList">
        <dt>Faculty of Mechanical Engineering</dt>
            <dd>Charles' square (Karlovo naměstí) & Horská</dd>
        <dt>Faculty of Electrical Engineering</dt>
            <dd>Charles' square (Karlovo naměstí)</dd>
        <dt>Faculty of Nuclear Sciences and Physical Engineering</dt>
            <dd>Břehová & Trojanova</dd>
        <dt>Faculty of Transportation Sciences</dt>
            <dd>Konviktská & Na Florenci & Horská</dd>
        <dt>Faculty of Biomedical Engineering</dt>
            <dd>Kladno, Náměstí Sítná (25 km from Prague)</dd>
    </dl>

    <h2 id="important-contacts">Important contacts &amp; addresses</h2>

    <h3 id="ctu-international-office">CTU International Office</h3>
    <p>The International Office of CTU is located on the 8th floor of the Rectorate building
        (Address: <a href="https://goo.gl/maps/pGbmkgxfb772" target="_blank">Jugoslávských partyzánů 1580/3, Praha 6, 160 00</a>)
        (The entrance with the water fountain)</p>
    <p>The head of the Department for International Relations is <strong>Ing. Volfgang Melecký, Ph.D.</strong>
        The key contact person for Erasmus &amp; Exchange students is <strong>Lucie Bílová</strong>.
        She will help you to fulfill the requirements for your Erasmus+ or Exchange study program, and to deal with any problems that arise.</p>
    <p>If you are interested attending a <em>Czech Language Course</em> and/or the <em>Czech Culture Course</em>
        you can contact <strong>Mgr. Kateřina Bošková</strong>. These lessons are offered by CTU for ECTS credits.
        For further information visit <a href="https://international.cvut.cz" target="_blank">CTU International Office website</a></p>

    <h4 id="ctu-international-office-contacts">Contacts</h4>
    <dl class="contactsList">
        <dt>Ing. Volfgang Melecký, Ph.D.</dt>
            <dd>Room: A-811</dd>
            <dd>Phone: <a href="tel:+420 224 353 465">+420 224 353 465</a></dd>
            <dd>Email: <a href="mailto:volfgang.melecky@cvut.cz">volfgang.melecky@cvut.cz</a></dd>
        <dt>MSc. Jaroslav Krpec</dt>
            <dd>Room: A-801a</dd>
            <dd>Phone: <a href="tel:+420 224 353 466">+420 224 353 466</a></dd>
            <dd>Email: <a href="mailto:jaroslav.krpec@cvut.cz">jaroslav.krpec@cvut.cz</a></dd>
        <dt>Ms. Lucie Bílová</dt>
            <dd>Room: A-802a</dd>
            <dd>Phone: <a href="tel:+420 224 353 467">+420 224 353 467</a></dd>
            <dd>Email: <a href="mailto:lucie.bilova@cvut.cz">lucie.bilova@cvut.cz</a></dd>
    </dl>

    <h4 id="lucie-bilova-office-hours">Lucie Bílová's office hours</h4>
    <dl class="contactsList">
        <dt>Monday &ndash; Thursday</dt>
            <dd>8:00 &ndash; 11:00</dd>
            <dd>13:00 &ndash; 15:30</dd>
        <dt>Friday</dt>
            <dd>8:00 &ndash; 11:00</dd>
            <dd>13:00 &ndash; 15:00</dd>
    </dl>

    <p class="bg-info">Note : If you are studying for a degree awarded by CTU, your contact person is always your Faculty coordinator.</p>

   <h3 id="faculty-contacts">Faculties, Institutes &amp; Contact persons</h3>
    <dl class="contactsList">
        <dt>Faculty of Civil Engineering</dt>
            <dd><a href="http://stuk.fsv.cvut.cz/wp-content/uploads/2016/03/plánek-fakulty-se-studijními-prostory.jpg" target="_blank">Map of the faculty</a></dd>
            <dd>Thákurova 7, Prague 6, 166 29</dd>
            <dd>Ing. Ditta Saláková, office: C-114</dd>
            <dd>Study Department</dd>
            <dd>Phone: <a href="tel:+420 224 358 757">+420 224 358 756</a></dd>
            <dd>Email: <a href="mailto:salakova@fsv.cvut.cz">salakova@fsv.cvut.cz</a></dd>
        <dt>Faculty of Mechanical Engineering</dt>
            <dd><a href="https://www.fs.cvut.cz/en/studies/bachelor-and-master-studies/location-of-lecture-halls-and-classes/" target="_blank">Map of the faculty</a></dd>
            <dd>Technicka 4, Prague 6, 166 07</dd>
            <dd>Simona Jordakova, office: A2-44B</dd>
            <dd>Study Department</dd>
            <dd>Phone: <a href="tel:+420 224 352 656">+420 224 352 656</a></dd>
            <dd>Email: <a href="mailto:simona.jordakova@fs.cvut.cz">simona.jordakova@fs.cvut.cz</a></dd>
        <dt>Faculty of Electrical Engineering</dt>
            <dd><a href="https://www.fel.cvut.cz/en/glance/rooms.html" target="_blank">Map of the faculty</a></dd>
            <dd>Technicka 2, Prague 6, 166 27</dd>
            <dd>Barbora Sovova, office: A3-21D</dd>
            <dd>Study Department</dd>
            <dd>Phone: <a href="tel:+420 224 352 027">+420 224 352 027</a></dd>
            <dd>Email: <a href="mailto:barbora.sovova@fel.cvut.cz">barbora.sovova@fel.cvut.cz</a></dd>
        <dt>Faculty of Nuclear Sciences and Physical Engineering</dt>
            <dd><a href="https://www.fjfi.cvut.cz/en/faculty/contact" target="_blank">Map of the faculty</a></dd>
            <dd>Břehova 7, Prague 1, 115 19</dd>
            <dd>Lucie Novotná, room No. B1 (ground floor)</dd>
            <dd>Dean's Office</dd>
            <dd>Phone: <a href="tel:+420 224 358 284">+420 224 358 284</a></dd>
            <dd>Email: <a href="mailto:lucie.novotna@fjfi.cvut.cz">lucie.novotna@fjfi.cvut.cz</a></dd>
        <dt>Faculty of Architecture</dt>
            <dd>Thákurova 9, Prague 6, 166 34</dd>
            <dd>Bc. Jarmila Vokounová Ransdorfová, office: 147</dd>
            <dd>Department for International Relations</dd>
            <dd>Phone: <a href="tel:+420 224 356 224">+420 224 356 224</a></dd>
            <dd>Email: <a href="mailto:jarmila.vokounova@fa.cvut.cz">jarmila.vokounova@fa.cvut.cz</a></dd>
        <dt>Faculty of Transportation Sciences</dt>
            <dd><a href="https://www.fd.cvut.cz/english/faculty/contacts.html" target="_blank">Contacts &amp; buildings</a></dd>
            <dd>Konviktska 20, Prague 1, 110 00</dd>
            <dd>Lýdie Tetíková, office: 204</dd>
            <dd>Study Department</dd>
            <dd>Phone: <a href="tel:+420 224 359 540">+420 224 359 540</a></dd>
            <dd>Email: <a href="mailto:tetiklyd@fd.cvut.cz">tetiklyd@fd.cvut.cz</a></dd>
        <dt>Faculty of Biomedical Engineering</dt>
            <dd><a href="http://en.fbmi.cvut.cz/information-for-students/prospective-full-time-students/rooms-and-classrooms" target="_blank">Classrooms location</a></dd>
            <dd>Náměstí Sítná 3105, Kladno 2, 272 01</dd>
            <dd>Lucie Kulhánková, office: B-506</dd>
            <dd>Department of Biomedical Informatics</dd>
            <dd>Phone: <a href="tel:+420 224 358 493">+420 224 358 493</a></dd>
            <dd>Email: <a href="mailto:kulhankova@fbmi.cvut.cz">kulhankova@fbmi.cvut.cz</a></dd>
        <dt>Faculty of Information Technology</dt>
            <dd><a href="https://www.fit.cvut.cz/en/student/classrooms" target="_blank">Classrooms location</a></dd>
            <dd>Thákurova 9, Prague 6, 160 00</dd>
            <dd>Ludmila Facer, office: T9:312d</dd>
            <dd>Office of Study Affairs</dd>
            <dd>Phone: <a href="tel:+420 224 359 837">+420 224 359 837</a></dd>
            <dd>Email: <a href="mailto:ludmila.facer@fit.cvut.cz">ludmila.facer@fit.cvut.cz</a></dd>
        <dt>Masaryk Institute of Advanced Studies</dt>
            <dd>Kolejní 2637/2a, Prague 6, 160 00</dd>
            <dd>Mgr. Gabriela Dohnalová, office: m111</dd>
            <dd>Department for International Cooperation</dd>
            <dd>Phone: <a href="tel:+420 224 353 153">+420 224 353 153</a></dd>
            <dd>Email: <a href="mailto:gabriela.dohnalova@cvut.cz">gabriela.dohnalova@cvut.cz</a></dd>
        </dl>

    <dl class="contactsList">
        <dt>For private (self-paying) students, seeking a CTU degree</dt>
            <dd>Contact your <a href="http://www.studyatctu.com/study-advisor-service/facultuy-coordinators/" target="_blank">faculty coordinator</a>, please</dd>
            <dd>For further information, contact the study advisors: Jakub Marek and Adela Bimova</dd>
            <dd>Rectorate, office: B3-250</dd>
            <dd>Department of External Affairs</dd>
            <dd>Skype: studyatCTU</dd>
            <dd>Email: <a href="mailto:advisor@studyatctu.com">advisor@studyatctu.com</a></dd>
    </dl>

    <dl class="contactsList">
        <dt>The ISC Point</dt>
            <dd>The Masarykova dormitory</dd>
            <dd>3rd floor, follow the arrows</dd>
        <dt>International Office of CTU</dt>
            <dd>See address above</dd>
        <dt>Student House</dt>
            <dd>Canteen, Student ID office</dd>
    </dl>

@stop
