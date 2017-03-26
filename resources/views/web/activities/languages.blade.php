@extends('web.layouts.activities')
@section('content')
    <div class="container subpage">
        <ul class="row list-unstyled contacts">
            <li class="col-md-4 col-sm-6 col-md-offset-4">
                <img src="{{ asset('img/web/contacts/2017spring/Languages_Verca.jpg') }}"class="img-circle">
                <div class="contact-details">
                    <h4>Verča Paštyková</h4><br>
                    <strong>Languages Coordinator</strong><br>
                    Email: <a href="mailto:languages@isc.cvut.cz">languages@isc.cvut.cz</a><br>
                    Phone: (+420) 775 478 059<br>
                </div>
                <span class="clearfix"></span>
            </li>
        </ul>
        <blockquote><p>One language sets you in a corridor for life. Two languages open every door along the way.</p><p><small>Frank Smith</small></p></blockquote>

        <div class="row">
            <div class="col-sm-8">
                <h2>LANGUAGE COURSES</h2>
                <span class="show-menu"></span>
                <p>Would you like to improve your knowledge of foreign languages or teach your language? </p>
                <p>Take advantage of our free language courses! The courses are taught by you -
                    Erasmus and exchange students, Czech students and foreigners living in Prague.
                    They are <strong>free of charge</strong>, fun, and no registration is needed.
                    We start in the third week of the semester (6th March 2017) and the courses take place in the
                    Masarykova dormitory and at Strahov, block 8.



                    <br><br>
                    <!--

                                    <a class="btn btn-primary" href="http://www.isc.cvut.cz/files/languages-schedule.php">Have a look at the <b>Fall 2016 schedule</b></a>
                                </p> -->
                <h2>Languages courses are over for this semester</h2>
                <br><br>
                <p>
                    <b>Where are the classrooms?</b><br>
                    <b>B305</b> is located on the 3rd floor of the
                    <a href="https://goo.gl/maps/au5lF">Masarykova dormitory</a> near ISC Point.<br>
                    <b>R404</b> is located on the 4th floor of the
                    <a href="https://goo.gl/maps/au5lF">Masarykova dormitory</a>,
                    same place as ISC Point, just one floor higher.<br>
                    <b>Strahov room</b> is located on the 2nd floor in
                    <a href="https://goo.gl/maps/Vy0nZ">block 8</a> (mezzanine), near stairs.

                </p>

                <h2>TANDEM</h2>
                <p>Tandem is a way of mutual learning and teaching languages. Basically, you will find someone who would
                    teach you a foreign language and you would teach him yours in return.</p>
                <p>The main advantage of Tandem is that it will be just you two who will set the time and the intensity
                    of the courses! You can form as many couples as you wish. </p>
                <p>Register in the <a href="http://isc.cvut.cz/tandem">Tandem database</a> and find your Tandem partner!

                <h2>CAFÉ LINGEA</h2>
                <p>Café Lingea is a conversational meeting where we informally chat in different languages
                    (English + some chosen). Café Lingea takes place in a different coffee shop or restaurant each time,
                    so it is also a good opportunity to discover some new places in Prague. Join the Facebook group
                    <a href="https://www.facebook.com/groups/125659680939345">ISC Café Lingea</a>!</p>
                <p>Café Lingeas are here for you every 2 weeks!</p>

                <br>

                <!--
                <h2 class="align-center">OVERVIEW OF THE SPRING 2016 EVENTS</h2>
    -->

                <!-- -------------- rozvrh languages eventů ---------------------->
                <table class="presentations-list">
                    <thead>
                    <tr>
                        <th>Event</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Where</th>
                        <th>More info</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Tandem Evening</td>
                        <td>Monday 13th February</td>
                        <td>8pm</td>
                        <td><a href="https://goo.gl/maps/2c3qWUjNYE32">Café V lese</a></td>
                        <td><a href="https://www.facebook.com/events/614492665410482/">Facebook event</a></td>
                    </tr>
                    <tr>
                        <td>1st Café Lingea (English & Czech)</td>
                        <td>Thursday 2nd March</td>
                        <td>6pm</td>
                        <td><a href="https://goo.gl/maps/7ZDHTrYMUGU2">Kabinet Café</a></td>
                        <td><a href="https://www.facebook.com/events/662297163977690/">Facebook event</a></td>
                    </tr>
                    <tr>
                        <td>2st Café Lingea (English & German)</td>
                        <td>Wednesday 15th March</td>
                        <td>7pm</td>
                        <td><a href="https://goo.gl/maps/geJkF7cp8iA2">Bernard Pub Cesta Časem</a></td>
                        <td><a href="https://www.facebook.com/events/1748119202185320/">Facebook event</a></td>
                    </tr>
                    			<!--	<tr>
                                    <td colspan=5><i>More events will be announced soon!</i></td>
                                    </tr> -->
                    @if(isset($langEvents) && $langEvents->count() > 0)
                        @foreach($langEvents as $langEvent)
                            <tr>
                                <td>{{ $langEvent->event->name }}</td>
                                <td>{{ $langEvent->event->datetime_from->format('l, jS F') }}</td>
                                <td>{{ $langEvent->event->getTimeFormatted() }}</td>
                                <td><a {{  isset($langEvent->where_url)? 'href='.$langEvent->where_url : ''  }} target="_blank">{{ $langEvent->where }}</a></td>
                                <td><a {!! isset($langEvent->event->facebook_url)? 'href='.$langEvent->event->facebook_url : ''  !!} target="_blank">Facebook event</a></td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4 schedule">
                <h2>See the schedule</h2>
                <!--<p>You can have a look at <a href="#" data-toggle="modal" data-target=".schedule-detail">the actual schedule</a> NOW! See the variety of our languages!</p> -->



                <p>You can have a look at the <a href="http://www.isc.cvut.cz/files/languages-schedule.php" target="_blank">Spring 2017 schedule</a>.</p>
                <!-- <p>Schedule for upcoming semester will be available in first week of the semester</p> -->
                <p>The language courses are starting on <b>Monday 6th March</b>.</p>
                <p style="height:250px;width:250px;margin-left:auto;margin-right:auto;text-align:center;"><a href="http://www.isc.cvut.cz/files/languages-schedule.php" ><img src="{{ asset('/img/web/lang-schedule-icon.jpg') }}"></a></p>
                <p>Sometimes the classes have to be cancelled for various reasons. The following table shows the updated list of cancelled and rescheduled classes.</p>
                <iframe width="370" height="400" frameborder="0" src="https://docs.google.com/spreadsheet/pub?key=0AoZEq64G2cV4dHZtcHdlVlpOV3F0WHNtVHlXS0tOTHc&single=true&gid=0&output=html&widget=true"></iframe>

            </div>
            <div class="modal fade schedule-detail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <!-- <img src="/img/courses.png"> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid faq" id="faq">
        <div class="row">
            <h1>FAQ</h1>
            <ul id="questions" class="list-unstyled">
                <li><h2>LANGUAGE COURSES</h2></li>
                <li id="parent1">
                    <a data-toggle="collapse" data-parent="parent2" href="#collapse1">For whom are the language courses? Can I join the course even if I am not a student of CTU of Prague?</a>
                    <p id="collapse1" class="panel-collapse collapse">The courses are for everyone who has an interest or a desire to learn a foreign language. The courses attendance is practically in no way restricted. The courses are open to everyone - both the students of CTU and the students of other universities and high schools. And those who do no study anymore are welcome as well.</p>
                </li>
                <li id="parent2"><a data-toggle="collapse" data-parent="parent1" href="#collapse2">Do I have to register?</a>
                    <p id="collapse2" class="panel-collapse collapse">NO registration is necessary, you just need to pick a course and come. :)</p>
                </li>

                <li id="parent3"><a data-toggle="collapse" data-parent="parent3" href="#collapse3">Are the courses really for free?</a>
                    <p id="collapse3" class="panel-collapse collapse">Yes, of course! (All teachers are volunteers.)</p>
                </li>

                <li id="parent4"><a data-toggle="collapse" data-parent="parent4" href="#collapse4">Where are the courses held? How can I find a classroom?</a>
                    <p id="collapse4" class="panel-collapse collapse">The courses are held in two classrooms at the Masarykova dormitory in Dejvice (J 390 a H 339) and in one classroom at Strahov, block 8.
                        H339 - <a href="http://www.youtube.com/watch?v=Fnl4UN8JqU0">See how to get there</a>.</p>
                </li>

                <li id="parent5"><a data-toggle="collapse" data-parent="parent5" href="#collapse5">Can I become a teacher even if I have never taught before? How can I sign in?</a>
                    <p id="collapse5" class="panel-collapse collapse">YES. Everyone who has a desire to teach their native language can become a teacher. If you are interested, sign in at <a href="mailto:languages@isc.cvut.cz">languages@isc.cvut.cz</a></p>
                </li>

                <li id="parent6"><a data-toggle="collapse" data-parent="parent6" href="#collapse6">Are the courses really for free?</a>
                    <p id="collapse6" class="panel-collapse collapse">Yes, of course! (All teachers are volunteers.)</p>
                </li>

                <li><h2>TANDEM</h2></li>

                <li id="parent7"><a data-toggle="collapse" data-parent="parent7" href="#collapse7">How can I join Tandem?</a>
                    <p id="collapse7" class="panel-collapse collapse">Register in the <a href="http://isc.cvut.cz/tandem">Tandem database</a>, find your tandem partner and contact him/her by e-mail.</p>
                </li>


                <li id="parent8"><a data-toggle="collapse" data-parent="parent8" href="#collapse8">What is the advantage of the Tandem program?</a>
                    <p id="collapse8" class="panel-collapse collapse">The advantage is certainly a more personal and individual approach to the language teaching. Mainly, thanks to the fact that the pace of learning, conversation topics and a teaching schedule are all chosen by you and your partner only.</p>
                </li>

                <li><h2>CAFÉ LINGEA</h2></li>

                <li id="parent9"><a data-toggle="collapse" data-parent="parent9" href="#collapse9">What languages do we speak?</a>
                    <p id="collapse9" class="panel-collapse collapse">Usually we speak English and one other language (Spanish, German, French, Russian and also Finnish for instance.) What language we will speak next time can be found on our website or in the fb group (ISC Café Lingea).</p>
                </li>

                <li id="parent10"><a data-toggle="collapse" data-parent="parent10" href="#collapse10">Can I come if I am not fluent in the spoken language (or if I am beginner)?</a>
                    <p id="collapse10" class="panel-collapse collapse">YES, for sure. Café Lingea is here because we want to meet not only to talk but also to learn few phrases, vocabulary and also something about the other culture. So you surely do not need to be afraid to come.</p>
                </li>

            </ul>
        </div>
    </div>
@endsection