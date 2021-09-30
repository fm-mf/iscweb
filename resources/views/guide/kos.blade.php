@extends('guide.layouts.subpage')

@section('subtitle', 'KOS')

@section('subpage')
    <h2>KOS & Classes registration</h2>

    <ul class="list-unstyled">
        <li>You are required to submit a Learning agreement before your arrival, and to earn at least 15 ECTS credits/semester</li>
        <li>Classes offered: <a href="https://international.cvut.cz/students/incoming-students/erasmus-and-exchange/courses-for-ee-students-prospectus/">Prospectus catalogue</a></li>
    </ul>

    <h3 id="courses-registration">Registration to the courses</h3>

{{--    <p class="alert alert-info">--}}
{{--        Your study department will contact you in the matter of registrations for clases etc. Please, check your e-mail inbox.--}}
{{--    </p>--}}


    <p>
        Registration is done during the <a href="{{ route('guide-page', ['page' => 'orientation-week#day-2-registration']) }}">Orientation week</a>,
        a visit to the study department at your faculty will be organized by ISC (except faculties with on-line registration),
        where you will get to know your classes and your schedule.
    </p>
    <p>
        It might take longer than you expect, reserve the entire morning in your calendar for this.
    </p>
    {{--
    <p>
        There is no electronic registration, because you are a non-standard student with an individual study program, and you are not going to graduate from CTU
    </p>
    --}}



    <h3 id="kos">KOS (Study information system)</h3>
    <ul class="list-unstyled">
        <li>First you have to get your <strong>login information</strong> in the VIC centre (Student House, <a href="https://goo.gl/maps/PcZMkQ6UZRn" target="_blank">Bechyňova 2571/3, Praha 6</a>, the same place where you get your University ID card)
            <ul>
                <li>You will get it together with the <a href="{{ route('guide-page', ['page' => 'cards#university-id']) }}">University ID card</a>.</li>
                <li>You can get it from Friday, 10 September 2021</li>
            </ul>
        </li>
        <li>Then visit <a href="https://kos.cvut.cz">KOS page</a>, switch to English (first) and log in</li>
        <li>In &quot;Subjects&quot; and &quot;Timetable&quot; you can see enrolled courses and your schedule</li>
        <li>In &quot;Assessments and exams&quot; you can see your exam dates (if arranged) and sign up for them and check your study results</li>
        <li>In &quot;Subjects&quot; &rArr; &quot;Course enrollment - According to code&quot; you can enroll new courses from your home faculty (only) if you have found them in the prospectus and they fit into your schedule (for courses at a different faculty, you visit the study department)</li>
        <li>After this you usually have to navigate to &quot;Timetable&quot; &rArr; &quot;Create personal timetable&quot; and sign up for one of offered lectures and seminars by hitting &quot;Zapsat&quot;. Then it should appear in your timetable</li>
        <li>May differ from faculty to faculty</li>
        <li>It is best to go to your <strong>study department</strong> and ask the lady to make the changes (sometimes only they can enter the changes)</li>
        <li>More information in presentation on the first day of Orientation Week</li>
    </ul>
    {{--<h4>OW presentation form Monday</h4>--}}
    <ul class="list-unstyled">
        <li><a href="{{ url('/kos-manual') }}">KOS manual</a></li>
    </ul>
@stop
