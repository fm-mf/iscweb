@extends('guide.layouts.subpage')

@section('subtitle', 'Orientation week')

@section('subpage')
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

    <div class="row">
        <div class="col-md-12 bg-warning">
    {{--        <p>--}}
    {{--            This is preliminary programme. Events may be moved to another days of the week. Details will be added during September.--}}
    {{--        </p>--}}
            <p>
                Due to pandemic situation, the schedule and programme can change, please check this page regularly for updates. Definitive programme will be announced on Monday during the presentation. You can also follow the
                <a href="{{ $linkOwFbEvent }}" target="_blank" rel="noopener">OW FB event</a>
                for up to date information.
            </p>
        </div>
    </div>

    
    @component('guide.section-nav', ['items' => [
        'day-1' => [
            'title' => "Day 1 - $owDay1",
            'items' => [
                'initial-meeting' => 'Initial information meeting',
                'tandem-evening' => 'Tandem Evening'
            ]
        ],
        'day-2' => [
            'title' => "Day 2 - $owDay2",
            'items' => [
                'day-2-registration' => 'Registration at faculties',
                'trips-meeting' => 'Second information meeting'
            ]
        ],
        'day-3' => [
            'title' => "Day 3 - $owDay3",
            'items' => [
                'survival-czech-talk' => 'Survival Czech Talk',
                'day-3-registration' => 'Prague Discovery Game',
                'integreat-party' => 'inteGREATion party'
            ]
        ],
        'day-4-7' => [
            'title' => "Day 4-7 – $owTripsDays",
            'items' => [
                'trips' => 'Trips around the Czech Republic'
            ]
        ],
    ]])
    @endcomponent

{{--
    <div class="row">
        <div class="col-md-12 bg-info">
            <p><strong>The schedule of the Orientation Week will be announced soon. Stay tuned!</strong></p>
        </div>
    </div>
--}}

    <div class="row">
        <h2 id="day-1">DAY 1 – <strong>{{ $owDay1 }}</strong></h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 id="initial-meeting">Initial information meeting</h3>
            <ul class="list-unstyled">
                <li>When: <strong>13:00</strong> - 17:30</li>
                <li>Where: <a href="https://goo.gl/maps/wM3StYxDz8x3ipKx8" target="_blank"><strong>Bethelem Chappel</strong></a> (Betlémské nám. 255/4, 110 00 Staré Město)</li>
                
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

            <div class="bg-info">
                <p>Due to pandemic situation, it's uncentrain when and where will this event happen. Please check this page during September for more info.</p>
            </div>
            {{--
            <ul class="list-unstyled">
                
                <li>When: <strong>21:00</strong></li>
                <li>Where: <a href="https://goo.gl/maps/ckJhJfZxaJuqnjfE7" target="_blank" rel="noopener"><strong>P.M. Club</strong> (Trojická 1907, 128 00 Nové Město)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>20:00 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li>See <a href="{{ url('activities/language-programs') }}" target="_blank">Language programs</a></li>
            </ul>
            --}}
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
        <h2 id="day-2">DAY 2 – {{ $owDay2 }}</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 id="day-2-registration">Registration at faculties</h3>

            <p class="bg-warning">
                Note: <strong>This is only for Erasmus students and Exchange students</strong>. Self-funding students who are studying for a CTU degree, and also Erasmus Mundus students, please contact Faculty coordinators at your study department.
            </p>

            <p class="bg-danger">Registration at your faculty is <strong>mandatory</strong>. If you can't attend this registration, you need to inform your faculty!</p>

            <p class="bg-info">The schedule will be announced during September</p>

            <ul class="list-unstyled">
                {{--<li>More information during the Monday presentation</li>--}}

                {{--TBA:
                <li><strong>When:</strong>
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

                <li><strong>Where:</strong> At your faculty (more information in the presentations on the first day)</li>
                
                <li>Meeting points:
                    <ul>
                        <li>FBMI &ndash; 7:45 in the lobby of the Masarykova dormitory</li>
                        <li>FD &ndash; 8:45 at Entrance to Národní Třída metro station</li>
                        <li>FS &ndash; 8:45 in front of the faculty</li>
                        <li>FEL &ndash; 8:45 in front of the faculty</li>
                        <li>FIT &ndash; 9:50 by the entrance door FA</li>
                    </ul>
                </li>

                <li><abbr title="Faculty of Civil Engineering">FSv</abbr> has registrations on day 3</li>
                --}}

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
                <li>When: <strong>13:30</strong></li>
                <li>Where: <strong><a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank">Faculty of Mechanical Engineering</a>, room T4:D2-256</strong></li>
                <li>Topics:
                    <ul>
                        <li>Presentation of ISC trips</li>
                        <li>Registrations for trips organized for days 4&ndash;7 (<strong>ESNcard + cash needed</strong>)</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <h2 id="day-3">DAY 3 – {{ $owDay3 }}</h2>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 id="survival-czech-talk">Survival Czech Talk</h3>
            <ul class="list-unstyled">
                <li>How do I ask for a beer in Czech? How do I pronounce “ř” and other strange letters? And if I want to say “hi, bye, thanks, please”, and more in Czech, what are the proper words? Learn this and more with the Rectorate teacher of Czech, Eva dos Reis, who will give you 90 minutes of exposure to the elementary stuff you better know NOW!</li>

                <li>When: <strong>9:00 - 10:30</strong> OR <strong>11:00 - 12:30</strong></li>
                <li>Where: <strong><a href="https://goo.gl/maps/qN4e4UDXfeAkVw1b7" target="_blank">CTU Rectorate</a>, building B, CIIRC Red Room</strong></li>
                
                <li>If you want to attend the Survival Czech Talk <a href="https://cvut.us20.list-manage.com/track/click?u=9b8d409b5e6e6e9214f58de33&id=691692a15d&e=6858531003" target="_blank">register in the form</a> and choose which time you want to attend. If the situation about Covid-19 gets worse, the course will be held online via Zoom or some similar platform.</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 id="day-3-registration">Registration at faculties</h3>

            <p class="bg-info">The schedule will be announced during September</p>

            {{--
            <p>When: <strong>10:00</strong> &ndash; <abbr title="Faculty of Civil Engineering">FSv</abbr></p>
        
            <li>Meeting points:
                <ul>
                    <li>FSv &ndash; 9:50 in front of the faculty</li>
                </ul>
            </li>  
            --}}   
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h3 id="prague-discovery-game">Prague Discovery Game</h3>
            <p>A great treasure hunt across Prague organized by the ISC Activities team</p>
            <ul class="list-unstyled">
                <li>When: <strong>13:00</strong></li>
                <li>Where: <strong><a href="https://goo.gl/maps/Lbp6SLLrovP2" target="_blank">Faculty of Mechanical Engineering</a>, room T4:D2-256</strong></li>
                {{--<li>When: in the afternoon</li>--}}
                {{--<li>Where: <abbr title="To be announced">TBA</abbr> soon</li>--}}
            </ul>
        </div>
    </div>

    {{-- TBA
    <div class="row">
        <div class="col-lg-12">
            <h3 id="integreat-party">inteGREATion party</h3>
            <p>Get to know each other at the very first ISC inteGREAT party and have fun!</p>
            <ul class="list-unstyled">
                <li>When: <strong>21:00</strong></li>
                <li>Where: <a href="https://goo.gl/maps/ebTnpr9oMqtAWj4a9" target="_blank" rel="noopener"><strong>Chapeau Rouge Bar</strong> (Jakubská 2, 110 00 Staré Město)</a></li>
                <!--
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
    --}}

    <div class="row">
        <h2 id="day-4-7">DAY 4–7 – {{ $owTripsDays }} </h2>
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
