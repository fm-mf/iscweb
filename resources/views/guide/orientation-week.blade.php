@extends('layouts.guide.layout')
@section('content')

    <div class="row">
        <h1>Orientation week</h1>
    </div>

    <div class="row">
        <div class="col-md-12 bg-danger">
            <p>Orientation week is held by ISC one week before semester starts and it provides you many important informations
                which can simplify your first days of your stay in the Czech Republic.
                It is strongly recommended to attend this program.
                During this week you will get to know the main bureaucracy at the CTU.
                Besides, we will help you to make new local and international friends through parties, games and a lot of trips.
                You shouldn’t miss this great opportunity!
            </p>
        </div>
    </div>{{--
    <div class="row">
        <p>
            See <a href="https://isc.cvut.cz/ow">Meeting points and times</a>
        </p>
    </div>

    The schedule of the Orientation Week will be announced soon. Stay tuned!--}}

    <div class="row">
        <h2>{{ $owFromTo }}</h2>
    </div>

    <div class="row">
        <h2>DAY 1 - Monday <strong>(September 25th)</strong></h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Initial information meeting</h3>
            <ul class="list-unstyled">
                <li>When: <strong>10:30</strong> - 15:00</li>
                <li>Where: <a href="https://goo.gl/maps/pHLFL6ZP8uP2" target="_blank"><strong>The Bethlehem Chapel</strong> (Betlémské náměstí 255/4, Praha 1)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>9:00 at Strahov</li>
                        <li>9:30 in the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li>Topics:
                    <ul>
                        <li>Official welcome</li>
                        <li>How to enroll in courses and sports at the CTU</li>
                        <li>Czech language and Czech culture courses</li>
                        <li>Life in the Czech Republic and how to survive in Prague</li>
                        <li>ESN membership</li>
                        <li>ISC teams and activities</li>
                        <li>Insurance and Visa regulations</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Tandem Evening</h3>
            <p>A unique program for improving your skills organized by ISC Languages team</p>
            <ul class="list-unstyled">
                <li>When: TBA</li>
                <li>Where: TBA</li>
                <li>Meeting points:
                    <ul>
                        <li>At Strahov</li>
                        <li>In the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
                <li>See: <a href="{{ url('activities/language-programs') }}" target="_blank">{{ url('activities/language-programs') }}</a></li>
            </ul>
        </div>
    </div>
    {{--
    <div class="row">
        <div class="col-lg-12">
            <h3>OW presentation Monday</h3>
            <ul class="list-unstyled">
                <li><a href="{{ asset('/files/OW_S2017/OW_S2017_Meeting_points_Registrations_at_faculties.pdf') }}">Registrations at faculties</a></li>
                <li><a href="{{ asset('/files/OW_S2017/OW_S2017_CTU_Sports.pdf') }}">Sport at CTU</a></li>
                <li><a href="{{ asset('/files/OW_S2017/OW_S2017_CTU_Visa.pdf') }}">Visa</a></li>
                <li><a href="{{ asset('/files/OW_S2017/OW_S2017_Czech_courses.pdf') }}">Czech courses</a></li>
                <li><a href="{{ asset('/files/OW_S2017/KOS_manual_CTU_Spring_2017.pdf') }}">KOS manual</a></li>
            </ul>
        </div>
    </div>
    --}}

    <div class="row">
        <h2>DAY 2 - Tuesday (September 26th)</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Registation at faculties</h3>
            <p class="bg-info">
                Note: <strong>Only for Erasmus students and Exchange students</strong>. Self-paying and Erasmus Mundus students, please contact Faculty coordinators at your study department.
            </p>
            <ul class="list-unstyled">
                <li>When: Various times for different faculties</li>
                <li>Where: At your faculty (more informations in the presentations on the first day)</li>
                <li class="bg-danger">You will need:
                    <ul>
                        <li>The green <strong>study record book</strong> from the Welcome pack</li>
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
                <li>When: <strong>14:00</strong> - 16:30</li>
                <li>Where: Congress Hall of the Masarykova dormitory</li>
                <li>Topics:
                    <ul>
                        <li>ISC trips presentations and registrations (<strong>ESNcard + cash needed</strong>)</li>
                        <li>ISC care</li>
                        <li>Your email account</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Blind Date</h3>
            <p>An interesting dating game organized by ISC Care team</p>
            <ul class="list-unstyled">
                <li>When: in the evening</li>
                <li>Where: TBA</li>
            </ul>
        </div>
    </div>
    {{--
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ asset('/files/OW_S2017/OW_S2017_Meeting_points_Registrations_at_faculties.pdf') }}">Meeting points - Tuesday</a>
        </div>
    </div>
    --}}

    <div class="row">
        <h2>DAY 3 - Wednesday (September 27th)</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Registation at faculties</h3>
            <p class="bg-info">Apply the same informations as for DAY 2</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Prague Discovery Game (PDG)</h3>
            <p>A great treasure hunt across Prague organized by ISC Activities team</p>
            <ul class="list-unstyled">
                <li>When: in the afternoon</li>
                <li>Where: Faculty of Mechanical Engineering, room 256</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>inteGREATion party</h3>
            <p>Get to know each other at the very first ISC inteGREAT party and have fun!</p>
            <ul class="list-unstyled">
                <li>When: 21:00</li>
                <li>Where: <a href="https://goo.gl/maps/NYAwpVKPeyJ2" target="_blank">P.M. Club (Trojická 10, Praha 2)</a></li>
                <li>Meeting points:
                    <ul>
                        <li>At Strahov</li>
                        <li>In the lobby of the Masarykova dormitory</li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <h2>DAY 4-7 - Thursday to Sunday (September 28th – October 1st) </h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Registation at faculties</h3>
            <p class="bg-info">Applies the same informations as for DAY 2</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>Trips around the Czech Republic</h3>
            <p>One-day or two-day events introducing you to a lot of interesting places</p>
            <ul class="list-unstyled">
                <li>When/Where: various times and places for each trip, more informations on DAY 2 at the second information meeting</li>
                <li class="bg-danger">You will need:
                    <ul>
                        <li>Cash</li>
                        <li>Little snacks and beverage</li>
                        <li>Comfortable clothes and shoes</li>
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