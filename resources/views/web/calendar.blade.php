@extends('web.layouts.subpage')
@section('wrapper-class', 'calendar-wrapper')
@section('navClass', 'navbar-dark')
@section('title', 'Calendar')

@section('content')
    <!-- <h1>There are no UPCOMING EVENTS. Wait for the next semester ;-)</h1>
    <h2><IMG src="{{ asset('img/web/fb_blue.png') }}"><a href="https://www.facebook.com/isc.ctu.prague/events"> Subscribe</a></h2> -->
    <!-- h1>ORIENTATION WEEK | Feb 13th &ndash; Feb 2th<br>
    <small>for incoming spring 2017 exchange students</small>
    </h1 -->
    <span class="vspace"></span>


    <div class="container events">
        <div class="container container-ow container-sm-height">

            <span class="vspace"></span>
            <div class="row row-ow row-sm-height">
                <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ asset('/img/web/events/2017_lingea3.jpg') }})">
                    <span class="day">Monday<br>March<br><strong>27th</strong><br>6pm</span>
                    <h2>3rd Café Lingea (English + Italian)</h2>
                </div>
                <div class="col-sm-6 ow-detail col-sm-height col-top" >
                    <p>► When: Monday, March 27th, at 18:00<br>
                        ► Were: <a href="https://goo.gl/maps/24Utk5NnMhK2">Cafe Prostoru_</a>
                    <p>
                        Hello and welcome!
                        The third Cafe Lingea italian/english takes place in Cafe Prostoru in the national technical library
                        in Campus. We begin at 18:00 on Monday and you’re free to speak in any language you want italian, english,
                        czech or perhaps some other langauge. If you have something which is somehow related to Italy don’t hesitate
                        and bring it. This event is also an opportunity to made new friends. Italian speaking people will be surely
                        excited to teach you a bit of italian 😉
                    </p>
                    <p>
                        ► <a href="https://www.facebook.com/events/168795366971963/"><strong>Facebook event!</strong></a>
                    </p>
                    <br>
                </div>
            </div>

            <span class="vspace"></span>
            <div class="row row-ow row-sm-height">
                <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ asset('/img/web/events/krakow_spring2017.jpg') }})">
                    <span class="day">Fri &ndash; Sun<br>Mar - Apr<br><strong>31st &ndash; 2nd</strong><br>5:30am</span>
                    <h2>Krakow + Auschwitz Trip</h2>
                </div>
                <div class="col-sm-6 ow-detail col-sm-height col-top" >
                    <p> <!-- ►Meetin point: <a href="https://goo.gl/maps/LHRwtJ3SwHM2">At the lobby Masarykova dormitory</a><br> -->
                        ► Price: 3300CZK (register in the ISC Point from 20th March)
                    <p>Do you want to spend another wonderful weekend with ISC Spirit and also discover something from
                        Europe heritage? Join us to Cracow trip. Cracow is historical city inscribed in the World Heritage
                        List. We will also visit former concentration camp Auschwitz-Birkenau and one of the oldest salt
                        mines in the world - Wieliczka.
                    </p>

                    <p>
                        ► <a href="https://www.facebook.com/events/382871975444995/"><strong>Facebook event! (more details)</strong></a>
                    </p>
                    <br>
                </div>
            </div>

            <span class="vspace"></span>
            <div class="row row-ow row-sm-height">
                <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ asset('/img/web/events/integreat/inteGREAT.jpg') }})">
                    <span class="day">Wednesday<br>April<br><strong>5th</strong><br>9pm</span>
                    <h2>inteGREAT ★ Spain & Argentina & Mexico</h2>
                </div>
                <div class="col-sm-6 ow-detail col-sm-height col-top" >
                    <p>
                        ► Who? ◄ Spain & Argentina & Mexico<br>
                        ► When? ◄ Wednesday, 5. 4. 2017, 9 pm<br>
                        ► Where?◄ <a href="https://www.rockcafe.cz/en/">Rock Cafe</a> (Národní 20, 110 00 Praha 1)<p>

                    <p>
                        ► <a href="https://www.facebook.com/events/1734126273568608/"><strong>Facebook event!</strong></a>
                    </p>
                    <p>★ International
                        ★ Night
                        ★ Team-work
                        ★ Entertainment
                        ★ Global
                        ★ Real
                        ★ Extraordinary
                        ★ Amazing
                        ★ Together</p>
                    inteGREAT more than a party
                </div>
            </div>

            @if(isset($events) && $events->count() > 0)
                @foreach($events as $event)
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ url($event->cover()) }})">
                            <span class="day">{{ $event->datetime_from->format('l') }}<br>{{ $event->datetime_from->format('F') }}<br>
                                <strong>{{ $event->datetime_from->format('jS') }}</strong><br>
                                {{ $event->datetime_from->format('g') }}{{ ($event->datetime_from->minute == 0) ? $event->datetime_from->format('a') : $event->datetime_from->format(':ia') }}</span>
                            <h2>{{ $event->name }}</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">

                                {!! $event->description !!}

                            @if(isset($event->facebook_url) && $event->facebook_url != NULL)
                            <p>
                                ► <a href="{{ $event->facebook_url }}"><strong>Facebook event!</strong></a>
                            </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </div>


            <!-- JAK MA VYPADAT EVENT
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/event.jpg);">
                            <span class="day">Thursday<br>February<br><strong>26th</strong><br>9pm</span>
                            <h2>inteGREAT: <br>PORTUGAL & ITALY & HUNGARY<br><br>(Style: RnB & HIP HOP)</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">
                            <p>
                            ISC inteGREAT is pleased to invite you to the very first Presentation Party which takes place on THURSDAY 26 February. Come to party with us and we guarantee you won’t regret it! DELICIOUS food and drinks typical for the presenting countries to taste, plenty of INTERESTING people to meet, AWESOME music to dance to and much more is waiting for you!
                            </p>
                            <p>
                            Bring your best mood, put on your dancing shoes, take along some friends and come join us for a wild time!!
                            </p>
                            <p>
                            <b>Where:</b> <a href="http://goo.gl/maps/uwtL2">Solidni Jistota (Pstrossova 200, Prague 1)</a>
                            </p>
                            <p>
                            ► <a href="https://www.facebook.com/events/1566871973561686">Facebook event</a>
                            </p>
                        </div>
                    </div>
            -->

        <!--
        <span class="vspace"></span>

        <div class="row row-ow row-sm-height">
            <div class="col-sm-6 ow-day ow-2 col-sm-height" style="background-image:url(../img/events/jeseniky.jpg);">
                <span class="day">Friday - Monday<br>April<br><strong>3rd - 6th</strong></span>
                <h2>ISC Jeseniky Hike</h2>
            </div>
            <div class="col-sm-6 ow-detail col-sm-height col-top">
                <p>
                    Join us for three days of hiking in one of the highest Czech mountains! Prepare for more than 50 km hike through amazing nature with beautiful view from the mountain tops.
                </p>
                <p>
                    Accomodation will be in hotels/cabins, transportation by train.
                </p>
                <p>
                   More info will be added soon.
                </p>
                <p>
                    <b>Contacts:</b> Pavel Hošek, 728356682, pavel.hosek.cz@gmail.com

                </p>

                <p>
                    ► <a href="https://www.facebook.com/events/812059892216097/">Facebook event</a>
                </p>

            </div>
        </div>
        -->

            <!-- ------------------------------- Party sample -------------------------------------------- -->
            <!--
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/events/integreat/spring2015/usa2.jpg);">
                            <span class="day">Wednesday<br>October<br><strong>14th</strong></span>
                            <h2>ISC CTU & inteGREAT:
                                <br>Chill-Out Party
                                <br>(Korea)</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">
                            <p>
                            Join us for another inteGREAT party, taking place on WEDNESDAY 14th. This time Korea will be presenting about their wonderfull country. You should not miss it. We are starting at 9pm with food presentation and presentation is starting at 10pm.
                            </p>

                            <p>
                                Bring your best mood, put on your dancing shoes, take along some friends and come join us for a wild time!!
                            </p>

                            <p>
                            <b>Where?</b> <a href="maplink">NOD</a>
                            <b>When?</b> at 9 pm
                            </p>


                            <p>
                            ► <a href="link">Facebook event</a>
                            </p>

                        </div>
                    </div>
            -->

            <!-- Vera TEST
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/events/lan_bulanci.jpg);">
                            <span class="day">Sunday<br>January<br><strong>10th</strong></span>
                            <h2>Your WEB has a new MASTER</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">
                            <p>
                            <b>We got one genuine feedback</b>
                            "I find you guys awkward but I appreciate your effort and it's because of people like you, not me, that the world goes round, so keep it up."
                            </p>

                            <p>
                            <b>Jste připraveni na nový semestr?</b>
                            </p>

                            <p>
                            Kdo uhádne, co budeme hrát na přístí LAN Party?
                            ►Neváhej a
                             <a href="http://goo.gl/forms/3uXIdPCIXS">napiš</a>!
                            </p>

                        </div>
                    </div>
            -->


            <!-- -------- NEW EVENT TEMPLATE ;-) --------------
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/events/integreat/integreat_korea.jpg);">
                            <span class="day">Wednesday<br>November<br><strong>30th</strong></span>
                            <h2>Event</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">
                            <p>

                            </p>
                            <p>

                                <b>Registration?</b> come to <a href="https://goo.gl/maps/OCtHW">ISC Point (R304)</a> and pay there
                                <br>
                                <b>Price?</b>  CZK
                            </p>

                            <p>
                                <b>Where?</b> <a href="link">NOD</a>
                                <b>When?</b> at 9 pm

                                <br>
                                <b>Meeting point?</b>

                            </p>


                            <p>
                                ► More info soon in Facebook event
                                ► <a href="link">Facebook event</a>
                            </p>

                        </div>
                    </div>


            -->


            <!-- ------------------------ OW Fall 2016 --------------------------------------------------------- -->
        <!-- h1>ORIENTATION WEEK | Sep 26th &ndash; Oct 2nd<br>
    <small>for incoming fall 2016 exchange students</small>
</h1>
<div class="container events">
    <div class="container container-ow container-sm-height">
        <div class="row row-ow row-sm-height">
            <div class="col-sm-6 ow-day ow-4 col-sm-height">
                <span class="day">Thu &ndash; Sun<br><strong class="h-trips">Sep 29th &ndash; Oct 2nd</strong></span>
                <h2>Orientation Week Trips</h2>
            </div>
            <div class="col-sm-6 ow-detail col-sm-height col-top">
				<p>
                During the Orientation Week you will also have an amazing opportunity to explore some great places around the Czech Republic with ISC members.
				</p>
				<p>
                <table class="trips-list">
                    <tr>
                        <th>South Moravia</th>
                        <td>Thursday 29th - Friday 30th</td>
                    </tr>
                    <tr>
                        <th>Jeseníky Mountains</th>
                        <td>Thursday 29th - Saturday 1st</td>
                    </tr>
                    <tr>
                        <th>Petřín Hill & Prague Castle</th>
                        <td>Friday 30th</td>
                    </tr>
                    <tr>
                        <th>Ostrava - The City of Steel</th>
                        <td>Saturday 1st - Sunday 2nd</td>
                    </tr>
                    <tr>
                        <th>Adršpach</th>
                        <td>Saturday 1st - Sunday 2nd</td>
                    </tr>
                    <tr>
                        <th>Czech Switzerland & Lužické Mts.</th>
                        <td>Saturday 1st - Sunday 2nd</td>
                    </tr>
                    <tr>
                        <th>Kutná Hora</th>
                        <td>Saturday 1st</td>
                    </tr>
                    <tr>
                        <th>Walk & Campfire in Prokop Valley</th>
                        <td>Saturday 1st</td>
                    </tr>
                    <tr>
                        <th>Pilsen</th>
                        <td>Sunday 2nd. Meeting point: <a href="https://www.google.cz/maps/place/50%C2%B006'07.1%22N+14%C2%B023'20.3%22E/@50.1019704,14.3714626,14z/data=!3m1!4b1!4m5!3m4!1s0x0:0x0!8m2!3d50.1019722!4d14.3889722">HERE</a>, Departure time: 9:00</td>
                    </tr>
                    <tr>
                        <th>Nostalgic Tram Ride</th>
                        <td>Sunday 2nd</td>
                    </tr>
                </table>
				</p>
            </div>
        </div>
        <!-- ------------------------ OW Fall 2016 --------------------------------------------------------- -->


            <!-- ------------------------ div nemazat --------------------------------------------------------- -->






    <!-- ------------------------pokusná část --------------------------------------------------------- -->


    <!-- ------------------------pokusná část --------------------------------------------------------- -->

    <span class="vspace"></span>

@endsection