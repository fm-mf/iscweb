@extends('web.layouts.layout')
@section('title', 'Language programs – Activities')

@section('page')
    <section class="activities-header">
    </section>
    @include('web.partials.activities-menu')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-auto mx-auto">
                    <blockquote class="motivation-quote">
                        <p>
                            One language sets you in a corridor for life. Two languages open every
                            door along the way.
                        </p>
                        <p>
                            Frank Smith
                        </p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2>Language courses</h2>
                    <p>
                        Would you like to improve your knowledge of foreign languages or teach your language?
                    </p>
                    <p>
                        Take advantage of our free language courses! The courses are taught by you –
                        Erasmus and exchange students, Czech students and foreigners living in Prague.
                        They are <strong>free of charge</strong>, fun, and no registration is needed.
                    </p>
                    <p>
                        Languages courses in the Autumn semester 2024/2025 will start on <strong>Monday, 7 October 2024</strong>,
                        and their schedule will be announced one week before that.
                    </p>
                    <p>
                        Are you interested in teaching a language with the ESN? That's great, we would like to have you!
                        Contact the Languages Coordinator (see the contact information at the bottom of the webpage).
                    </p>
                    <p>
                        <a class="btn btn-primary" href="{{ url('files/languages-schedule.php') }}">
                            Have a look at the <b>Autumn 2024 schedule</b>
                        </a>
                    </p>
                    <h3>Where are the classrooms?</h3>
                    <dl class="room-location">
                        <dt>B305</dt>
                        <dd>
                            is located on the 3rd floor of the
                            <a href="https://goo.gl/maps/au5lF" target="_blank" rel="noopener">Masarykova dormitory</a>
                            near ESN Point
                        </dd>
                        <dt>R404</dt>
                        <dd>
                            is located on the 4th floor of the
                            <a href="https://goo.gl/maps/au5lF" target="_blank" rel="noopener">Masarykova dormitory</a>
                            same place as ESN Point, just one floor higher
                        </dd>
                        <dt>Strahov room</dt>
                        <dd>
                            is located on the 2nd floor in
                            <a href="https://goo.gl/maps/Vy0nZ" target="_blank" rel="noopener">block 8</a>
                            (mezzanine), near stairs
                        </dd>
                    </dl>

                    <h2>Tandem</h2>
                    <p>Tandem is a way of mutual learning and teaching languages. Basically, you will find someone who would
                        teach you a foreign language and you would teach him yours in return.</p>
                    <p>The main advantage of Tandem is that it will be just you two who will set the time and the intensity
                        of the courses! You can form as many couples as you wish. </p>
                    <p>Register in the <a href="{{ url('tandem') }}">Tandem database</a> and find your Tandem partner!</p>
                    <!-- <p>Come to the <strong>Tandem evening on Monday 14 October</strong> in the Storm club!
                        See the <a href="https://www.facebook.com/events/345928639923952/" target="_blank" rel="noopener">facebook event</a>.</p> -->
                    <p><a href="{{ url('/tandem') }}" class="btn btn-primary"><span class="fas fa-sign-in-alt"></span> Tandem database</a></p>

                    <h2>Café Lingea</h2>
                    <p>Café Lingea is a conversational meeting where we informally chat in different languages
                        (English + some chosen). Café Lingea usually takes place in different coffee shops or
                        restaurants, so it is also a good opportunity to discover some new places in Prague.
                    {{-- Join the Facebook group
                        <a href="https://www.facebook.com/groups/125659680939345" target="_blank" rel="noopener">ESN Café Lingea</a>!</p>
                    <p>Café Lingeas are here for you every 2 weeks!</p>--}}

                    {{---------------- rozvrh languages eventů ----------------}}
                    @if(isset($langEvents) && $langEvents->count() > 0)
                        <h3>Overview of the {{ $currentSemester }} events</h3>
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
                                @foreach($langEvents as $langEvent)
                                    <tr>
                                        <td>{{ $langEvent->event->name }}</td>
                                        <td>{{ $langEvent->event->datetime_from->format('l, j F') }}</td>
                                        <td>{{ $langEvent->event->getTimeFormatted() }}</td>
                                        <td><a {{  isset($langEvent->where_url)? 'href='.$langEvent->where_url : ''  }} target="_blank">{{ $langEvent->where }}</a></td>
                                        <td><a {!! isset($langEvent->event->facebook_url)? 'href='.$langEvent->event->facebook_url : ''  !!} target="_blank">Facebook event</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                <div class="col-md-4 schedule">
                    <h2>See the schedule</h2>
                    <p>You can have a look at the
                        <a href="{{ url('files/languages-schedule.php') }}" target="_blank">
                            Autumn 2024 schedule
                        </a>
                    </p>{{--
                    <p>
                        The only language course running during the exam period is the Czech course on Wednesday.
                        The schedule for the autumn courses will be published at the beginning of October 2019.
                    </p>--}}
                    {{-- <p>
                        Schedule for upcoming semester will be available in the second week of the semester.
                    </p> --}}
                    {{--<p>
                        Our currently offered courses will end according to every teachers' wish or latest at the end of June.
                        Schedule for the Autumn courses shall be published in October 2018.
                        Please note that during summer holidays there are no language classes provided by ESN.
                    </p>--}}
                    <p>
                        <a href="{{ url('files/languages-schedule.php') }}">
                            <img src="{{ asset('img/web/lang-schedule-icon.jpg') }}" />
                        </a>
                    </p>
                    <p>
                        Sometimes the classes have to be cancelled for various reasons.
                        The following table shows the updated list of cancelled and rescheduled classes.
                    </p>
                    <iframe width="360" height="240" frameborder="0" src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQnXcpxkS4GkgX_LsRkiAO15gb8_Dd_YT0nipSPN0vogdWX-6PIoxCUwtYgC41dOdZm3Oz16RMLV0ma/pubhtml?single=true&gid=802538365&output=html&widget=true"></iframe>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            @isset($contact)
                <div class="row contacts">
                    <div class="col-auto mx-auto">
                        @include('partials.contact', compact('contact'))
                    </div>
                </div>
            @endif
        </div>
    </section>

    <section id="languages-faq">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>FAQ</h2>
                    <h3>Language courses</h3>
                    <dl class="list-unstyled questions" id="faq-language-courses">
                        <dt id="question1">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer1">
                                For whom are the language courses? Can I join the course even if I am not a student of CTU of Prague?
                            </a>
                        </dt>
                        <dd id="answer1" class="collapse">
                            The courses are for everyone who has an interest or a desire to learn a foreign language.
                            The courses attendance is practically in no way restricted. The courses are open to everyone
                            – both the students of CTU and the students of other universities and high schools.
                            And those who do no study anymore are welcome as well.
                        </dd>

                        <dt id="question2">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer2">
                                Do I have to register?
                            </a>
                        </dt>
                        <dd id="answer2" class="collapse">
                            NO registration is necessary, you just need to pick a course and come. :)
                        </dd>

                        <dt id="question3">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer3">
                                Are the courses really for free?
                            </a>
                        </dt>
                        <dd id="answer3" class="collapse">
                            Yes, of course! (All teachers are volunteers.)
                        </dd>

                        <dt id="question4">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer4">
                                Where are the courses held? How can I find a classroom?
                            </a>
                        </dt>
                        <dd id="answer4" class="collapse">
                            The courses are held in two classrooms at the Masarykova dormitory
                            in Dejvice (B305 and R404) and in one classroom at Strahov, block 8.
                        </dd>

                        <dt id="question5">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer5">
                                Can I become a teacher even if I have never taught before? How can I sign in?
                            </a>
                        </dt>
                        <dd id="answer5" class="collapse">
                            YES. Everyone who has a desire to teach their native language can become
                            a teacher. If you are interested, sign in at
                            <a href="mailto:languages@esn.cvut.cz">languages@esn.cvut.cz</a>
                        </dd>

                        <dt id="question6">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer6">
                                Are the courses really for free?
                            </a>
                        </dt>
                        <dd id="answer6" class="collapse">
                            Yes, of course! (All teachers are volunteers.)
                        </dd>
                    </dl>

                    <h3>Tandem</h3>
                    <dl class="list-unstyled questions">
                        <dt id="question7">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer7">
                                How can I join Tandem?
                            </a>
                        </dt>
                        <dd id="answer7" class="collapse">
                            Register in the <a href="{{ url('tandem') }}">Tandem database</a>,
                            find your tandem partner and contact him/her by email.
                        </dd>

                        <dt id="question8">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer8">
                                What is the advantage of the Tandem program?
                            </a>
                        </dt>
                        <dd id="answer8" class="collapse">
                            The advantage is certainly a more personal and individual approach to
                            the language teaching. Mainly, thanks to the fact that the pace of
                            learning, conversation topics and a teaching schedule are all chosen by
                            you and your partner only.
                        </dd>
                    </dl>

                    <h3>Café Lingea</h3>
                    <dl class="list-unstyled questions">
                        <dt id="question9">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer9">
                                What languages do we speak?
                            </a>
                        </dt>
                        <dd id="answer9" class="collapse">
                            Usually we speak English and one other language (Spanish, German,
                            French, Russian and also Finnish for instance.) What language we will
                            speak next time can be found on our website or in the FB group (ESN Café Lingea).
                        </dd>

                        <dt id="question10">
                            <a data-toggle="collapse" data-parent="#languages-faq" href="#answer10">
                                Can I come if I am not fluent in the spoken language (or if I am beginner)?
                            </a>
                        </dt>
                        <dd id="answer10" class="collapse">
                            YES, for sure. Café Lingea is here because we want to meet not only to
                            talk but also to learn few phrases, vocabulary and also something about
                            the other culture. So you surely do not need to be afraid to come.
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </section>
@endsection
