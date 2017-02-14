@extends('layouts.guide.layout')
@section('content')

    <div class="row">
        <h1>Orientation week</h1>
    </div>

    <div class="row">
        <div class="col-md-12 bg-danger">It is strongly recommended to attend the Orientation Week, which is held in the last
            week before classes start. During this week, international students are introduced to
            the CTU educational system and are given information for their stay in the Czech Republic. They are helped to register for their courses, they meet Czech and international
            students, make some trips, and generally settle in before the semester begins. Do not
            miss this good opportunity.
        </div>
    </div>
    <!--div class="row">
        <p>
            See <a href="https://isc.cvut.cz/ow">Meeting points and times</a>
        </p>
    </div -->

    <!--The schedule of the Orientation Week will be announced soon. Stay tuned!-->

    <div class="row">
        <h3>{{ $owFromTo }}</h3>
    </div>

    <div class="row">
        <h3>DAY 1 - Monday <b>(February 13th)</b></h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            Initial information meeting at <b>10:30</b> - 14:30, <b>Faculty of Civil Engineering, room D-1122</b>
            <ul>
                <li>Official welcome</li>
                <li>How to "survive" in Prague</li>
                <li>Visa regulations and insurance policy</li>
                <li>Arranging all the necessary paperwork</li>
                <li>ISC membership</li>
                <li>Introduction to the Czech Culture Course</li>
                <li>Life in the Czech Republic</li>
                <li>How to enroll in courses</li>

            </ul>
        </div>
        <div class="col-lg-12">
            Tandem Evening (more info soon)
            <ul>
                <li>Enjoy the first beer of the semester and get involved in our unique language learning program! Here you can meet a tandem partner to practice your language skills and have a drink.</li>
            </ul>
        </div>
        <h4>OW presentation Monday</h4>

            <div class="col-lg-12">
                <a href="{{ asset('/files/OW_S2017/OW_S2017_Meeting_points_Registrations_at_faculties.pdf') }}">Registrations at faculties</a><br>
                <a href="{{ asset('/files/OW_S2017/OW_S2017_CTU_Sports.pdf') }}">Sport at CTU</a><br>
                <a href="{{ asset('/files/OW_S2017/OW_S2017_CTU_Visa.pdf') }}">Visa</a><br>
                <a href="{{ asset('/files/OW_S2017/OW_S2017_Czech_courses.pdf') }}">Czech courses</a><br>
                <a href="{{ asset('/files/OW_S2017/KOS_manual_CTU_Spring_2017.pdf') }}">KOS manual</a>
            </div>


    </div>

    <div class="row">
        <h3>DAY 2 - Tuesday (February 14th)</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            In the morning - <strong>Registration</strong> at the faculties (for Erasmus and Exchange students).<br><b>You will need:</b>
            <ul>
                <li><b>Study record book</b> (green booklet) from the Welcome Pack</li>
                <li>Passport photo</li>
                <li>Pen</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            2nd information meeting at 14:00 - 16:30, Congress hall of the Masarykova dormitory
            <ul>
                <li>ISC trip registrations (ESN card & cash needed)</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ asset('/files/OW_S2017/OW_S2017_Meeting_points_Registrations_at_faculties.pdf') }}">Meeting points - Tuesday</a>
        </div>
    </div>

    <div class="row">
        <h3>DAY 3 - Wednesday (February 15th)</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            Prague Discovery Game (PDG) at 13:30, Faculty of Electrical Engineering, room 256
            <ul>
                <li>Great treasure hunt organized by ISC</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            inteGREATion party in the evening at Storm Club
            <ul>
                <li>Get to know each other at the first ISC inteGREAT party and have fun!</li>
            </ul>
        </div>
    </div>

    <div class="row">
        <h3>DAY 4-7 - Thursday to Sunday (February 16th – 19th) </h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            Trips around the Czech Republic
            <ul>
                <li>Various trips (both one-day and weekend events) to many interesting places in the Czech Republic.</li>
                <li>A great opportunity to get to know other students!</li>
            </ul>
        </div>
    </div>
    <br>

    <div class="row">
        <div class="col-md-12 bg-danger">Please keep in mind there are four types of students: Erasmus students,
            Exchange students, Erasmus Mundus students and Private (self-paying)
            students.  Private  (self-paying)  students  and  Erasmus  Mundus  students
            please contact their coordinators at their study department for information about visa issues, registration at faculties, etc.
        </div>
    </div>
@stop