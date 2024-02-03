@extends('guide.layouts.subpage')

@section('subtitle', 'Orientation week')

@php
    $finalProgramme = true;
    $showSlidesAndRegistrations = true;
@endphp

@section('subpage')
    <h2>Orientation Week</h2>
    <div class="alert alert-danger">
        <p>
            Orientation Week is held by ISC one week before the semester starts
            and it provides you a lot of important information
            which will help you to settle in the Czech Republic.
            <strong>It is strongly recommended to attend this program.</strong>
            During this week you will get to know the main bureaucratic procedures at CTU.
        </p>
        <p class="mb-0">
            In addition, we will help you to make new local and international friends
            through parties, games and a lot of trips. You shouldn’t miss this great opportunity!
        </p>
    </div>

    @if(!$finalProgramme)
        <div class="alert alert-warning">
            <p class="mb-0">
                This is preliminary programme. Events may be moved to another days of the week.
                Details will be added during January.
            </p>
        </div>
    @endif

    @component('guide.components.section-nav', ['items' => [
        'day-1' => [
            'title' => "Day 1 – $owDay1",
            'items' => [
                'day-1-registration' => 'Registration at faculties',
                'initial-meeting' => 'Initial information meeting',
                // 'tandem-evening' => 'Tandem evening',
            ]
        ],
        'day-2' => [
            'title' => "Day 2 – $owDay2",
            'items' => [
                'day-2-registration' => 'Registration at faculties',
                'trips-meeting' => 'Second information meeting',
            ]
        ],
        'day-3' => [
            'title' => "Day 3 – $owDay3",
            'items' => [
                // 'survival-czech-talk' => 'Survival Czech Talk',
                'day-3-registration' => 'Registration at faculties',
                'prague-discovery-game' => 'Prague Discovery Game',
                'integreation-party' => 'inteGREATion party',
            ]
        ],
        'day-4-7' => [
            'title' => "Day 4–7 – $owTripsDays",
            'items' => [
                'trips' => 'Trips around the Czech Republic'
            ]
        ],
    ]])
    @endcomponent


    @if(!$finalProgramme)
        <div class="alert alert-info">
            <p class="mb-0"><strong>The schedule of the Orientation Week will be announced soon. Stay tuned!</strong></p>
        </div>
    @endif


    <h3 id="day-1">DAY 1 – <strong>{{ $owDay1 }}</strong></h3>

    <h4  id="day-1-registration">Registration at faculties</h4>
    <ul class="list-unstyled">
        <li>
            <ul>
                <li>For the <strong>Faculty of Architecture (FA)</strong> at 13:30 (presentation of atelier works) {{--in the auditorium T9:155 (Gočár)--}}</li>
                <li>For the <strong>Faculty of Mechanical Engineering (FS / FME)</strong> at 9:00, <a href="https://fs.cvut.cz/en/studies/bachelor-and-master-studies/location-of-lecture-halls-and-classes/" target="_blank">T4:C2-136</a></li>
            </ul>
        </li>
    </ul>

    <h4 id="initial-meeting">Initial information meeting</h4>
    <ul class="list-unstyled">
        <li>When: <strong>13:30</strong> – 16:30 (room opens at 13:15)</li>
{{--        <li>Where: <a href="https://goo.gl/maps/wM3StYxDz8x3ipKx8" target="_blank"><strong>Bethelem Chappel</strong></a> (Betlémské nám. 255/4, 110 00 Staré Město)</li>--}}
        <li>
            Where: <strong>
                <a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank">Faculty of Mechanical Engineering</a>,
                <a href="https://www.fs.cvut.cz/en/studies/bachelor-and-master-studies/location-of-lecture-halls-and-classes/" target="_blank">room T4:D2-256</a>
            </strong>
        </li>
{{--        <li>Where: <strong><a href="https://g.page/stavarnacvut?share" target="_blank">Faculty of Civil Engineering</a>, room TH:D-1122</strong></li>--}}
        {{--
        <li>Meeting points:
            <ul>
                <li>13:00 at Strahov (bus stop Koleje Strahov)</li>
                <li>13:20 in the lobby of the Masarykova dormitory</li>
            </ul>
        </li>
        --}}
        <li>Topics:
            <ul>
                <li>Official welcome</li>
                <li>How to enroll in courses and sports at CTU</li>
                {{--<li>Czech language and Czech culture courses</li>--}}
                <li>Life in the Czech Republic and how to survive in Prague</li>
                <li>ESN membership</li>
                <li>ISC teams and activities</li>
                <li>Health and property insurance</li>
                <li>Visa regulations</li>
            </ul>
        </li>
    </ul>

    {{--
    <h4 id="tandem-evening">Tandem Evening</h4>
    <p>A unique program for improving your language learning and teaching skills organized by ISC Languages team</p>
    <ul class="list-unstyled">
        <li>When: <strong>TBA</strong></li>
        <li>Where: <strong>TBA</strong></li>
        <li>Where: <a href="https://goo.gl/maps/YcQuZdgYB7d6yTnd6" target="_blank" rel="noopener"><strong>Storm Club</strong> (Tachovské náměstí 290/5, 130 00 Praha 3 – Žižkov)</a></li>
        <li>Where: <a href="https://goo.gl/maps/ckJhJfZxaJuqnjfE7" target="_blank" rel="noopener"><strong>P.M. Club</strong> (Trojická 1907, 128 00 Nové Město)</a></li>
        <li>Meeting points:
            <ul>
                <li>20:00 in the lobby of the Masarykova dormitory</li>
            </ul>
        </li>
        <li>See <a href="{{ url('activities/language-programs') }}" target="_blank">Language programs</a></li>
    </ul>
    --}}
    @if($showSlidesAndRegistrations)
    {{--<h4>Slides from the Initial information meeting</h4>
        <ul class="list-unstyled">
            <li>
                <a href="{{ asset('files/ow-2024_spring/ow-2024_Spring-registrations_at_faculties.pdf') }}" target="_blank">
                    <i class="fas fa-file-pdf"></i> Registrations at faculties (Spring 2024)
                </a>
            </li>
            <li>
                <a href="{{ asset('files/ow-2023_autumn/ow-2023_autumn-handout.pdf') }}" target="_blank">
                    <i class="fas fa-file-pdf"></i> Slides from the presentation OW Autumn 2023
                </a>
            </li>--}}
        </ul>
    @endif

    <h3 id="day-2">DAY 2 – {{ $owDay2 }}</h3>

    <h4 id="day-2-registration">Registration at faculties</h4>
    {{--
    <p>
        Your faculty should contact you about the online registration and all the steps needed.
    </p>
    --}}
    <p class="alert alert-warning">
        Note: <strong>This is only for Erasmus students and Exchange students</strong>.
        Degree students (those who are studying for a CTU degree), and also Erasmus Mundus students,
        please contact your Faculty coordinators at your study department.
    </p>
    <div class="alert alert-danger">
        <p>
            Registration at your faculty is <strong>mandatory</strong>.
            If you can't attend this registration, you need to inform your faculty!
        </p>
        <p class="mb-0">
            For the registration at faculties, you need to have the University ID username and password already.
            See <a href="{{ route('guide-page', ['page' => 'kos#kos']) }}" class="alert-link">KOS (Study information system)</a>.
        </p>
    </div>
    @if(!$showSlidesAndRegistrations)
        <p class="alert alert-info">
            Detailed instructions and schedule for faculties with in-person registration will be announced on {{ $owDay1 }},
            during the <a href="#initial-meeting" class="alert-link">Initial information meeting</a>.
        </p>
    @endif
    <p class="alert alert-info">
        <strong>Note:</strong> Even if you have courses at multiple faculties, you only need to attend
        the registration at the ‘main’ faculty you have in your learning agreement.
    </p>
    <ul class="list-unstyled">
        @if($showSlidesAndRegistrations)
            <li>
                <strong>In-person registration:</strong>
                <ul>
                    <li>Faculty of Electrical Engineering (FEL / FEE) – 9:00, Room T2:C3-132</li>
                    <li>Faculty of Transportation (FD / FT) – 9:00, building Konviktská 20, Prague 1; room 205</li>
                    <li>Masaryk Institute of Advanced Studies (MÚVS / MIAS) – 10:00, room 103 (at the ground floor)</li>
                    <li>Faculty of Architecture (FA) – Possible consultations at room T9:147, Thákurova 9</li>

                </ul>
            </li>
            <li>
                <strong>On-line registration:</strong>
                (faculty coordinator have already contacted you via e-mail with instructions)
                <ul>
                    <li>Faculty of Civil Engineering (FSv / FCE)</li>
                    <li>Faculty of Information Technology (FIT)</li>
                </ul>
            </li>
            <li>
{{--                <strong>For Faculty of Architecture (FA) and Faculty of Mechanical Engineering (FS) see <a href="#day-1">Day 1</a></strong>--}}
{{--                <strong>For other faculties see <a href="#day-3">Day 3</a></strong>--}}
            </li>
        @endif
        <li class="alert alert-danger"><strong>You will need:</strong>
            <ul>
                <li>A government-issued ID (e.g. passport)</li>
                <li>University ID username and password (a.k.a. KOS login information)</li>
                <li>A pen</li>
            </ul>
        </li>
        <li>You will receive:
            <ul>
                <li>The list of your classes</li>
                <li>Your schedule</li>
            </ul>
        </li>
    </ul>

    <h4 id="trips-meeting">Second information meeting</h4>
    <ul class="list-unstyled">
        <li>When: <strong>13:30</strong> – 15:00 (room opens at 13:15)</li>
        <li>
            Where: <strong>
                <a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank">Faculty of Mechanical Engineering</a>,
                <a href="https://www.fs.cvut.cz/en/studies/bachelor-and-master-studies/location-of-lecture-halls-and-classes/" target="_blank">room T4:D2-256</a>
            </strong>
        </li>
{{--        <li>Where: <strong><a href="https://g.page/stavarnacvut?share" target="_blank">Faculty of Civil Engineering</a>, room TH:D-1122</strong></li>--}}
{{--        <li>Where: <strong><a href="https://goo.gl/maps/Uxdt3bXSf9NwVk5M6" target="_blank">Masarykova dormitory</a>, Congress hall</strong></li>--}}
        <li>Topics:
            <ul>
                <li>Presentation of ISC trips</li>
                <li>Registrations for trips organized for <a href="#day-4-7">days 4–7</a> (<strong>ESNcard + cash needed</strong>)</li>
            </ul>
        </li>
    </ul>

    <h3 id="day-3">DAY 3 – {{ $owDay3 }}</h3>

    {{--
    <h4 id="survival-czech-talk">Survival Czech Talk</h4>
    <ul class="list-unstyled">
        <li>How do I ask for a beer in Czech? How do I pronounce “ř” and other strange letters? And if I want to say “hi, bye, thanks, please”, and more in Czech, what are the proper words? Learn this and more with the Rectorate teacher of Czech, Eva dos Reis, who will give you 90 minutes of exposure to the elementary stuff you better know NOW!</li>

        <li>When: <strong>9:00 - 10:30</strong> OR <strong>11:00 - 12:30</strong></li>
        <li>Where: <strong><a href="https://goo.gl/maps/qN4e4UDXfeAkVw1b7" target="_blank">CTU Rectorate</a>, building B, CIIRC Red Room</strong></li>

        <li>If you want to attend the Survival Czech Talk <a href="https://cvut.us20.list-manage.com/track/click?u=9b8d409b5e6e6e9214f58de33&id=691692a15d&e=6858531003" target="_blank">register in the form</a> and choose which time you want to attend. If the situation about Covid-19 gets worse, the course will be held online via Zoom or some similar platform.</li>
    </ul>
    --}}

    @if($showSlidesAndRegistrations)
        <h4 id="day-3-registration">Registration at faculties</h4>
        <ul class="list-unstyled">
            <li>
                <strong>In-person registration:</strong>
                <ul>
                    <li>Faculty of Nuclear Sciences and Physical Engineering (FJFI / FNSPE) – 9:30, meetup at 9:15 in the lobby, building Trojanova 339/13, Praha 2</li>
                    <li>Faculty of Biomedical Engineering (FBMI / FBME) – 9:00 in Kladno building (náměstí Sítná 3105, Kladno), room KL:B-435</li>
                </ul>
            </li>
            <li class="alert alert-info">
                <strong>See <a href="#day-2-registration" class="alert-link">Registration on Tuesday</a> for further information</strong>
            </li>
        </ul>
    @endif

    <h4 id="prague-discovery-game">Prague Discovery Game</h4>
    <p>A great treasure hunt across Prague organized by the ISC Activities team</p>
    {{--
    <p class="alert alert-info">
        The exact time and other instructions will be posted in the
        <a href="{{ $linkOwFbEvent }}" target="_blank" rel="noopener" class="alert-link">OW FB event</a>
        and on Monday, 13 September, during the Initial information meeting.
    </p>
    --}}
    <ul class="list-unstyled">
        <li>When: <strong>13:30</strong> (room opens at 13:15)</li>
        <li>
            Where: <strong>
                <a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank">Faculty of Mechanical Engineering</a>,
                <a href="https://www.fs.cvut.cz/en/studies/bachelor-and-master-studies/location-of-lecture-halls-and-classes/" target="_blank">room T4:D2-256</a>
            </strong>
        </li>
{{--        <li>Where: <strong><a href="https://goo.gl/maps/Uxdt3bXSf9NwVk5M6" target="_blank">Masarykova dormitory</a>, Congress hall</strong></li>--}}
{{--        <li>Where: <strong><a href="https://g.page/stavarnacvut?share" target="_blank">Faculty of Civil Engineering</a>, room TH:D-1122</strong></li>--}}
    </ul>

    <h4 id="integreation-party">inteGREATion party</h4>
    <p>Get to know each other at the very first ISC inteGREAT party and have fun!</p>
    <ul class="list-unstyled">
        <li>When: <strong>21:00</strong></li>
        {{-- <li>Where: <strong>TBA</strong></li> --}}
        <li>Where: <a href="https://goo.gl/maps/ckJhJfZxaJuqnjfE7" target="_blank" rel="noopener"><strong>P.M. Club</strong> (Trojická 1907, 128 00 Nové Město)</a></li>
        {{-- <li>Where: <a href="https://goo.gl/maps/YcQuZdgYB7d6yTnd6" target="_blank" rel="noopener"><strong>Storm Club</strong> (Tachovské náměstí 290/5, 130 00 Praha 3 – Žižkov)</a></li> --}}
        {{--
        <li>Meeting points:
            <ul>
                <li>19:30 at bus stop Koleje Strahov</li>
                <li>19:30 in the lobby of the Masarykova dormitory</li>
            </ul>
        </li>
        --}}
    </ul>

    <h3 id="day-4-7">DAY 4–7 – {{ $owTripsDays }} </h3>

    <h4 id="trips">Trips around the Czech Republic</h4>
    <p>One-day or two-day events introducing you to a lot of interesting places</p>
    <ul class="list-unstyled">
        <li>When/Where: different times and places for each trip, further information on DAY 2 during the <a href="#trips-meeting">Second information meeting</a></li>
        <li class="alert alert-danger">Do not forget:
            <ul>
                <li>Cash</li>
                <li>Small snacks and beverages</li>
                <li>Comfortable clothes and appropriate shoes</li>
            </ul>
        </li>
    </ul>

    @if(empty($owTrips) || $owTrips->isEmpty())
        <p>
            The Orientation week trips have not been published yet. Stay tuned!
        </p>
    @else
        <ul class="list-unstyled events">
            @foreach($owTrips as $trip)
                @include('partials.calendar-event', ['event' => $trip->event])
            @endforeach
        </ul>
    @endif

    <div class="alert alert-danger mt-5">
        <p class="mb-0">
            Please keep in mind there are four types of students: Erasmus students,
            Exchange students, Erasmus Mundus students and Private (self-paying)
            students.  Private  (self-paying)  students  and  Erasmus  Mundus  students,
            please, contact their coordinators at their study department for information
            about visa issues, registration at faculties, etc.
        </p>
    </div>
@stop
