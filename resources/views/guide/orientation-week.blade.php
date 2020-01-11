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
    </div>

    
    @component('guide.section-nav', ['items' => [
        'day-1' => [
            'title' => 'Day 1 - Monday (10th February)',
            'items' => [
                'initial-meeting' => 'Initial information meeting',
                'tandem-evening' => 'Tandem Evening'
            ]
        ],
        'day-2' => [
            'title' => 'Day 2 - Tuesday (11th February)',
            'items' => [
                'day-2-registration' => 'Registration at faculties',
                'trips-meeting' => 'Second information meeting'
            ]
        ],
        'day-3' => [
            'title' => 'Day 3 - Wednesday (12th February)',
            'items' => [
                'day-3-registration' => 'Prague Discovery Game',
                'integreat-party' => 'inteGREATion party'
            ]
        ],
        'day-4-7' => [
            'title' => 'Day 4-7 – Thursday to Sunday (13-16th February)',
            'items' => [
                'trips' => 'Trips around the Czech Republic'
            ]
        ],
    ]])
    @endcomponent

    <div class="row">
        <h2 id="programme">Orientation Week Programme: {{ $owFromTo }}</h2>
    </div>
    <div class="row">
        <div class="col-md-12 bg-warning">
    {{--        <p>--}}
    {{--            This is preliminary programme. Events may be moved to another days of the week. Details will be added during September.--}}
    {{--        </p>--}}
            <p>
                Check this page regularly for updates. You can also follow the
                <a href="{{ $linkOwFbEvent }}" target="_blank" rel="noopener">OW FB event</a>
                for up to date information.
            </p>
        </div>
    </div>
{{--
    <div class="row">
        <div class="col-md-12 bg-info">
            <p><strong>The schedule of the Orientation Week will be announced soon. Stay tuned!</strong></p>
        </div>
    </div>
--}}
    <div class="row">
        <h2 id="day-1">DAY 1 – Monday <strong>(10th February)</strong></h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 id="initial-meeting">Initial information meeting</h3>
            <ul class="list-unstyled">
                <li>When: <strong>13:30</strong> - 17:00</li>
                <li>Where: <a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank"><strong>Faculty of Mechanical Engineering, room T4: D2-256 and 358</strong></a></li>
                <!--
                <li>Meeting points:
                    <ul>
                        <li>13:00 at Strahov (bus stop Koleje Strahov)</li>
                        <li>13:20 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                -->
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
		        <!--
                <li>
                    <a class="btn btn-primary" href="{{ asset('files/ow-fall-2019/ow-fall-2019-complete.pdf') }}">
                        <span class="glyphicon glyphicon-file"></span> Download presentation
                    </a>
                </li>
                -->
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 id="tandem-evening">Tandem Evening</h3>
            <p>A unique program for improving your language learning and teaching skills organized by ISC Languages team</p>
            <ul class="list-unstyled">
                <li>When: <strong>TBA</strong></li>
                <!--
                <li>Where: <a href="https://goo.gl/maps/qgZJ57LcLtM2" target="_blank" rel="noopener"><strong>Storm Club</strong> (Tachovské náměstí 290/5, Prague 3)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>20:30 at bus stop Koleje Strahov</li>
                        <li><strong title="Meeting time changed">20:30</strong> <del title="Meeting time changed">20:45</del> in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li>See <a href="{{ url('activities/language-programs') }}" target="_blank">Language programs</a></li>
                -->
            </ul>
        </div>
    </div>
    {{--<div class="row">
        <div class="col-lg-12">
            <h3>OW presentation Monday</h3>
            <ul class="list-unstyled">
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/registrations-at-faculties-meeting-points-fall-2018.pdf') }}" target="_blank">Registrations at faculties</a></li>
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/ctu-czech-courses-fall-2018.pdf') }}" target="_blank">CTU &amp; Czech courses</a></li>
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/ctu-sports-fall-2018.pdf') }}" target="_blank">Sport at CTU</a></li>
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/visa-fall-2018.pdf') }}" target="_blank">Visa</a></li>
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/isc-fall-2018.pdf') }}" target="_blank">ISC &amp; ESN</a></li>
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/culture-fatigue-fall-2018.pdf') }}" target="_blank">Culture Shock</a></li>
--}}{{--
                <li><a href="{{ asset('/files/ow-presentations-fall-2018/esn-fall-2018.pdf') }}" target="_blank">ESN</a></li>
--}}{{--
                <li><a href="{{ asset('/files/ow-presentations-fall-2017/kos-manual-ctu-fall-2017.pdf') }}" target="_blank">KOS manual</a></li>
            </ul>
        </div>
    </div>--}}

    <div class="row">
        <h2 id="day-2">DAY 2 – Tuesday (11th February)</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 id="day-2-registration">Registration at faculties</h3>
            <p class="bg-info">
                Note: <strong>This is only for Erasmus students and Exchange students</strong>. Self-funding students who are studying for a CTU degree, and also Erasmus Mundus students, please contact Faculty coordinators at your study department.
            </p>
            <p class="bg-warning">Please attend this registration event at your faculty. Do not treat it as optional.</p>
	    <div class="row">
		<!--
        <div class="col-lg-12">
		    <a href="{{ asset('/files/ow-fall-2019/registrations-at-faculties.pdf') }}">Meeting points - Tuesday</a>
		</div>
        -->
	    </div>
            <ul class="list-unstyled">
                {{--<li>More information during the Monday presentation</li>--}}

                <li>When:
                    <ul>
                        <li>9:00 &ndash; <abbr title="Faculty of Transportation">FD</abbr>,
                            <abbr title="Faculty of Mechanical Engineering">FS</abbr>,
                            <abbr title="Faculty of Electrical Engineering">FEL</abbr>,
                            <abbr title="Faculty of Nuclear Sciences and Physical Engineering">FJFI</abbr>,
                            <abbr title="Faculty of Biomedical Engineering">FBMI</abbr>,
                            <abbr title="Masaryk Institute of Advanced Studies">MÚVS</abbr></li>
                        <li>9:30 &ndash; <abbr title="Faculty of Architecture">FA</abbr></li>
                        <li>10:00 &ndash; <abbr title="Faculty of Information Technology">FIT</abbr></li>
                    </ul>
                </li>

                <li><abbr title="Faculty of Civil Engineering">FSv</abbr> has registrations on day 3</li>

                <li>Where: At your faculty (more information in the presentations on the first day)</li>
                <!--
                <li>Meeting points:
                    <ul>
                        <li>FBMI &ndash; 7:50 in front of the Klokner Institute</li>
                        <li>FD &ndash; 8:25 in the lobby of the Masarykova dormitory</li>
                        <li>FJFI &ndash; 8:30 the end stop of busses 143 and 149 Dejvická</li>
                        <li>FSv &ndash; 8:55 in front of the faculty</li>
                        <li>FS &ndash; 8:55 in front of the faculty</li>
                        <li>FEL &ndash; 8:55 in front of the faculty</li>
                        <li>MÚVS &ndash; 8:55 in front of the faculty</li>
                        <li>FA &ndash; 9:20 in the atrium with yellow benches inside of the building</li>
                        <li>FIT &ndash; 9:50 in the lobby of the Masarykova dormitory & 9:55 in front of the faculty</li>
                    </ul>
                </li>
                -->
                <li class="bg-danger"><strong>You will need:</strong>
                    <ul>
                        <li>An ID (University ID / Passport)</li>
                        <li>A pen</li>
                        <li>Check the meeting points</li>
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
            <h3 id="trips-meeting">Second information meeting</h3>
            <ul class="list-unstyled">
                {{--<li>When: in the afternoon</li>--}}
                {{--<li>Where: <abbr title="To be announced">TBA</abbr> soon</li>--}}
                <li>When: <strong>12:45</strong></li>
                <li>Where: at Congress Hall of the Masarykova Dormitory</li>
                <li>Topics:
                    <ul>
                        <li>Presentation of ISC trips</li>
                        <li>Registrations for trips organized for days 4&ndash;7 (<strong>ESNcard + cash needed</strong>)</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    {{--<div class="row">--}}
    {{--    <div class="col-lg-12">--}}
    {{--        <h3>Blind Date</h3>--}}
    {{--        <p>An interesting dating game organized by ISC Care team</p>--}}
    {{--        <ul class="list-unstyled">--}}
    {{--            <li>When: in the evening</li>--}}
    {{--            <li>Where: TBA</li>--}}
    {{--        </ul>--}}
    {{--    </div>--}}
    {{--</div> --}}
    {{--
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ asset('/files/OW_S2017/OW_S2017_Meeting_points_Registrations_at_faculties.pdf') }}">Meeting points - Tuesday</a>
        </div>
    </div>
    --}}

    <div class="row">
        <h2 id="day-3">DAY 3 – Wednesday (12th February)</h2>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 id="day-3-registration">Registration at faculties</h3>

            <p>When: 10:00 &ndash; <abbr title="Faculty of Civil Engineering">FSv</abbr></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 id="prague-discovery-game">Prague Discovery Game</h3>
            <p>A great treasure hunt across Prague organized by the ISC Activities team</p>
            <ul class="list-unstyled">
                <li>When: <strong>13:30</strong></li>
                <li>Where: <a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank">Faculty of Mechanical Engineering</a>, room T4:D2-256</li>
                {{--<li>When: in the afternoon</li>--}}
                {{--<li>Where: <abbr title="To be announced">TBA</abbr> soon</li>--}}
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 id="integreat-party">inteGREATion party</h3>
            <p>Get to know each other at the very first ISC inteGREAT party and have fun!</p>
            <ul class="list-unstyled">
                <li>When: TBA</li>
                <!--
                <li>Where: <a href="https://goo.gl/maps/LANoqspoi362" target="_blank" rel="noopener"><strong>PM Club</strong> (Trojická 1907/10)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>19:30 at bus stop Koleje Strahov</li>
                        <li>19:30 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                -->
            </ul>
        </div>
    </div>

    <div class="row">
        <h2 id="day-4-7">DAY 4–7 – Thursday to Sunday (13-16th February) </h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 id="trips">Trips around the Czech Republic</h3>
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
            <p>
                Please keep in mind there are four types of students: Erasmus students,
                Exchange students, Erasmus Mundus students and Private (self-paying)
                students.  Private  (self-paying)  students  and  Erasmus  Mundus  students,
                please, contact their coordinators at their study department for information
                about visa issues, registration at faculties, etc.
            </p>
        </div>
    </div>
@stop
