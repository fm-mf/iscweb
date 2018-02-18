@extends('layouts.guide.layout')

@section('title', 'Orientation week &ndash; ')

@section('content')
    <div class="row">
        <h1>Orientation Week</h1>
    </div>

    <div class="row">
        <div class="col-md-12 bg-danger">
            <p>Orientation Week is held by ISC one week before the semester starts and it provides a lot of important information
                which will help you to settle in the Czech Republic.
                <strong>It is strongly recommended to attend this program.</strong>
                During this week you will get to know the main bureaucratic procedures at CTU.
                In addition, we will help you to make new local and international friends through parties, games and a lot of trips.
                You shouldn’t miss this great opportunity!
            </p>
        </div>
    </div>{{--
    <div class="row">
        <p>
            See <a href="https://isc.cvut.cz/ow">Meeting points and times</a>
        </p>
    </div>--}}

    <div class="row">
        <h2>Orientation Week Programme: {{ $owFromTo }}</h2>
    </div>
{{--
    <div class="row">
        <div class="col-md-12 bg-info">
            <p><strong>The schedule of the Orientation Week will be announced soon. Stay tuned!</strong></p>
        </div>
    </div>
--}}
    <div class="row">
        <h2>DAY 1 – Monday <strong>(12 February)</strong></h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Initial information meeting</h3>
            <ul class="list-unstyled">
                <li>When: <strong>10:30</strong> - 15:00</li>
                <li>Where: <a href="https://goo.gl/maps/pHLFL6ZP8uP2" target="_blank"><strong>The Bethlehem Chapel</strong> (Betlémské náměstí 255/4, Praha 1)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>9:00 at Strahov (bus stop Koleje Strahov)</li>
                        <li>9:30 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li>Topics:
                    <ul>
                        <li>Official welcome</li>
                        <li>How to enroll in courses and sports at CTU</li>
                        <li>Czech language and Czech culture courses</li>
                        <li>Life in the Czech Republic and how to survive in Prague</li>
                        <li>ESN membership</li>
                        <li>ISC teams and activities</li>
                        <li>Health and property insurance</li>
                        <li>Visa regulations</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Tandem Evening</h3>
            <p>A unique program for improving your language learning and teaching skills organized by ISC Languages team</p>
            <ul class="list-unstyled">
                <li>When: 20:00</li>
                <li>Where: <a href="https://goo.gl/maps/qgZJ57LcLtM2" target="_blank">Storm Club (Tachovské náměstí 290/5, Prague 3)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>19:15 at bus stop Koleje Strahov</li>
                        <li>19:00 on the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li>See: <a href="{{ url('activities/language-programs') }}" target="_blank">{{ url('activities/language-programs') }}</a></li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>OW presentation Monday</h3>
            <ul class="list-unstyled">
                <li><a href="{{ asset('/files/ow-presentations-spring-2018/ctu-czech-courses-spring-2018.pdf') }}" target="_blank">CTU &amp; Czech courses</a></li>
                <li><a href="{{ asset('/files/ow-presentations-spring-2018/ctu-sports-spring-2018.pdf') }}" target="_blank">Sport at CTU</a></li>
                <li><a href="{{ asset('/files/ow-presentations-fall-2017/kos-manual-ctu-fall-2017.pdf') }}" target="_blank">KOS manual</a></li>
                <li><a href="{{ asset('/files/ow-presentations-spring-2018/visa-spring-2018.pdf') }}" target="_blank">Visa</a></li>
                <li><a href="{{ asset('/files/ow-presentations-spring-2018/isc-spring-2018.pdf') }}" target="_blank">ISC</a></li>
                <li><a href="{{ asset('/files/ow-presentations-spring-2018/esn-spring-2018.pdf') }}" target="_blank">ESN</a></li>
                <li><a href="{{ asset('/files/ow-presentations-spring-2018/registrations-at-faculties-meeting-points-spring-2018.pdf') }}" target="_blank">Registrations at faculties</a></li>
            </ul>
        </div>
    </div>

    <div class="row">
        <h2>DAY 2 – Tuesday (13 February)</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Registration at some faculties</h3>
            <p class="bg-info">
                Note: <strong>This is only for Erasmus students and Exchange students</strong>. Self-funding students who are studying for a CTU degree, and also Erasmus Mundus students, please contact Faculty coordinators at your study department.
            </p>
            <p class="bg-warning">Please attend this registration event at your faculty. Do not treat it as optional.</p>
            <ul class="list-unstyled">
                <li>When:
                    <ul>
                        <li>9:00 &ndash; <abbr title="Faculty of Mechanical Engineering">FME</abbr>,
                            <abbr title="Faculty of Electrical Engineering">FEE</abbr>,
                            <abbr title="Faculty of Nuclear Sciences and Physical Engineering">FNSPE</abbr>,
                            <abbr title="Faculty of Biomedical Engineering">FBME</abbr>,
                            <abbr title="Masaryk Institute of Advanced Studies">MIAS</abbr></li>
                        <li>9:30 &ndash; <abbr title="Faculty of Architecture">FA</abbr></li>
                        <li>10:30 &ndash; <abbr title="Faculty of Information Technology">FIT</abbr></li>
                        <li>11:30 &ndash; <abbr title="Faculty of Civil Engineering">FCE</abbr></li>
                    </ul>
                </li>
                <li>Where: At your faculty (more information in the presentations on the first day)</li>
                <li>Meeting points:
                    <ul>
                        <li>FME &ndash; 8:45 in front of the faculty</li>
                        <li>FEE &ndash; 8:45 in front of the faculty</li>
                        <li>FNSPE &ndash; 8:30 in the lobby of the Masarykova dormitory</li>
                        <li>FBME &ndash; 8:00 in the lobby of the Masarykova dormitory</li>
                        <li>MIAS &ndash; 8:45 in the lobby of the Masarykova dormitory</li>
                        <li>FA &ndash; 9:15 in front of the faculty</li>
                        <li>FIT &ndash; 10:15 in front of the faculty</li>
                        <li>FCE &ndash; 11:15 in front of the faculty</li>
                    </ul>
                </li>
                <li class="bg-danger"><strong>You will need:</strong>
                    <ul>
                        <li>The green <strong>study record book</strong> from the Welcome Pack</li>
                        <li>A passport photo</li>
                        <li>A pen</li>
                    </ul>
                </li>
                <li>You will get:
                    <ul>
                        <li>The list of your classes</li>
                        <li>Your schedule</li>
                        <li>Your email account</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Second information meeting</h3>
            <ul class="list-unstyled">
                <li>When: <strong>15:30</strong></li>
                <li>Where: Faculty of Electrical Engineering, room 256 and 358</li>
                <li>Topics:
                    <ul>
                        <li>Presentation of ISC trips</li>
                        <li>Registrations for trips organized for days 4&ndash;7 (<strong>ESNcard + cash needed</strong>)</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>{{--
    <div class="row">
        <div class="col-lg-12">
            <h3>Blind Date</h3>
            <p>An interesting dating game organized by ISC Care team</p>
            <ul class="list-unstyled">
                <li>When: in the evening</li>
                <li>Where: TBA</li>
            </ul>
        </div>
    </div> --}}
    {{--
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ asset('/files/OW_S2017/OW_S2017_Meeting_points_Registrations_at_faculties.pdf') }}">Meeting points - Tuesday</a>
        </div>
    </div>
    --}}

    <div class="row">
        <h2>DAY 3 – Wednesday (14 February)</h2>
    </div>{{--
    <div class="row">
        <div class="col-lg-12">
            <h3>Registration at some faculties</h3>
            <ul class="list-unstyled">
                <li>When: TBA (more information in the presentations on the first day)
                    <ul>
                        <li>9:00 &ndash; <abbr title="Faculty of Mechanical Engineering">FME</abbr>, <abbr title="Faculty of Electrical Engineering">FEE</abbr>, <abbr title="Faculty of Transportation Sciences">FTS</abbr></li>
                    </ul>
                </li>
                <li>Where: At your faculty (more information in the presentations on the first day)</li>
                <li>Meeting points:
                    <ul>
                        <li>FME &ndash; 8:45 in front of the faculty</li>
                        <li>FEE &ndash; 8:50 in front of the faculty</li>
                        <li>FTS &ndash; 8:50 in front of the <a href="https://goo.gl/maps/pHLFL6ZP8uP2" target="_blank"><strong>Bethlehem Chapel</strong></a></li>
                    </ul>
                </li>
                <li class="bg-danger"><strong>You will need:</strong>
                    <ul>
                        <li>The green <strong>study record book</strong> from the Welcome Pack</li>
                        <li>A passport photo</li>
                        <li>A pen</li>
                    </ul>
                </li>
                <li>You will get:
                    <ul>
                        <li>The list of your classes</li>
                        <li>Your schedule</li>
                        <li>Your email account</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-lg-12">
            <h3>Czech Language Course</h3>
            <p>The Rectorate teacher of Czech, Eva dos Reis, will give you 90 minutes of exposure to the elementary stuff you better know NOW!</p>
            <ul class="list-unstyled">
                <li>When: <strong>9:00&ndash;10:30 or <strong>11:00</strong>&ndash;12:30</strong></li>
                <li class="bg-warning">Choose only one time, both of the lectures will be the same.</li>
                <li>Where: CTU Rectorate (Jugoslávských partyzánů 3, Prague 6), building B, 6th floor, room 671</li>
                <li>How do I ask for beer in Czech? How do I pronounce &quot;ř&quot; and other strange letters? And if I want to say &quot;hi, bye, thanks, please&quot;, and more in Czech, what are the proper words?</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Prague Discovery Game</h3>
            <p>A great treasure hunt across Prague organized by the ISC Activities team</p>
            <ul class="list-unstyled">
                <li>When: <strong>13:00</strong></li>
                <li>Where: Faculty of Electrical Engineering, room 256 and 358</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>inteGREATion party</h3>
            <p>Get to know each other at the very first ISC inteGREAT party and have fun!</p>
            <ul class="list-unstyled">
                <li>When: 21:00</li>
                {{--<li>Where: <a href="https://goo.gl/maps/NYAwpVKPeyJ2" target="_blank">P.M. Club (Trojická 10, Praha 2)</a></li>--}}
                <li>Where: <a href="https://goo.gl/maps/QHss48kzDon" target="_blank">Rock Café (Národní 116/20, Praha 1)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>20:30 at bus stop Koleje Strahov</li>
                        <li>20:30 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <h2>DAY 4–7 – Thursday to Sunday (15–18 February) </h2>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3>Registration at some faculties (on Thursday, 15 February)</h3>
            <ul class="list-unstyled">
                <li>When:
                    <ul>
                        <li>13:30 &ndash; <abbr title="Faculty of Transportation Sciences">FTS</abbr></li>
                    </ul>
                </li>
                <li>Where: At your faculty (more information in the presentations on the first day)</li>
                <li>Meeting points:
                    <ul>
                        <li>FTS &ndash; 13:00 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li class="bg-danger"><strong>You will need:</strong>
                    <ul>
                        <li>The green <strong>study record book</strong> from the Welcome Pack</li>
                        <li>A passport photo</li>
                        <li>A pen</li>
                    </ul>
                </li>
                <li>You will get:
                    <ul>
                        <li>The list of your classes</li>
                        <li>Your schedule</li>
                        <li>Your email account</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Trips around the Czech Republic</h3>
            <p>One-day or two-day events introducing you to a lot of interesting places</p>
            <ul class="list-unstyled">
                <li>When/Where: different times and places for each trip, further information on DAY 2 during the second information meeting</li>
                <li class="bg-danger">Do not forget:
                    <ul>
                        <li>Cash</li>
                        <li>Small snacks and beverages</li>
                        <li>Comfortable clothes and appropriate shoes</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 bg-danger">
            <p>Please keep in mind there are four types of students: Erasmus students,
                Exchange students, Erasmus Mundus students and Private (self-paying)
                students.  Private  (self-paying)  students  and  Erasmus  Mundus  students
                please contact their coordinators at their study department for information about visa issues, registration at faculties, etc.
            </p>
        </div>
    </div>
@stop
