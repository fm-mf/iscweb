@extends('web.layouts.layout')
@section('page')
    <section class="activities-header">
    </section>
    @include('web.partials.activities-menu')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-auto mx-auto">
                    <blockquote class="motivation-quote">
                        <p>Wherever you go becomes a part of you somehow.</p>
                        <p>Anita Desai</p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <h2>Trips</h2>
                    <p>The main objective of our trips is to get you acquainted with our historical and natural heritage, but also to make it easier for you to explore remarkable cities and places not only in the Czech Republic, but also in our neighboring countries.</p>
                    <p><!-- We want to help you better understand our cultural background and traditions, while visiting the most important Czech towns, castles, chateaus and historical monuments. --> You can <!-- therefore -->look forward to a great variety of sight-seeing trips, where we will try to combine pleasure and enjoyment with a great learning experience within the Czech Republic</p>
                    <p>Most of the trips are taking place in the Orientation Week, but several trips will be organized throughout the semester as well.</p>

                    <h2>How to register</h2>
                    <p>For the trips, which take place in the Orientation Week, you can register at the second orientation meeting where all details about our trips will be presented. Please, bring cash with you. Due to limited places for each trip it won't be possible to pay later.</p>
                    <p>We will announce new trips on our website and on Facebook during the semester. Shortly after the announcement, the registration in the ESN Point in the Masarykova dormitory will be opened, and you should enroll as soon as possible.</p>
                </div>
                <div class="col-sm-5">
                    <ul class="gallery list-unstyled">
                        <li>
                            <a href="{{ url('/img/web/activities/trips/trips1.jpg') }}" data-fancybox="gallery"><img src="{{ asset('/img/web/activities/trips/trips1-t.jpg') }}"></a>
                        </li>
                        <li>
                            <a href="{{ url('/img/web/activities/trips/trips2.jpg') }}" data-fancybox="gallery"><img src="{{ asset('/img/web/activities/trips/trips2-t.jpg') }}"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h2>Trips for {{ $currentSemester }} coming soon…</h2>
                    <p class="mt-5">
                        For fresh news about ESN events subscribe to <a href="https://www.facebook.com/esn.ctu.prague/events/">Facebook ESN CTU in Prague!</a>
                    </p>
                </div>
            </div>
            {{--
            <div class="container events" id="events">
                <!--	<div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/activities/trips/budapest.jpg);">
                                <span class="day">Saturday<br>March<br><strong>12th</strong><br>5 am</span>
                                <h2>Budapest Trip</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>
                                    We are going to Budapest together with erasmus students from University of Economics! Join our trip, meet new friends and visit one of the most beautiful cities in Europe.<br>
                                    You can register in the ESN Point.
                                </p>
                                <p>
                                    ► <strong>More info on</strong> <a href="https://www.facebook.com/events/1709595802586441/"><strong>Facebook event!</strong></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/events/krakov_2016.png);">
                            <span class="day">Thrusday<br>April<br><strong>7th</strong><br>10 pm</span>
                            <h2>Krakow trip</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">
                            <p>
                                A trip full of overwhelming, mysterious and frightening historical places is prepared! The old city of Polish kings, ancient salt mines, terrifyingly recent concentration camp and a lot more awaits you, so get on board!  </p>
                            <p>

                                <b>Registration?</b> come to <a href="https://goo.gl/maps/OCtHW">ESN Point (R304)</a> and pay there
                                <br>
                                <b>Price?</b> 3 100 CZK
                            </p>

                            <p>

                                ► More info on <a href="https://www.facebook.com/events/925994130832365/"><strong>Facebook event</strong></a>
                            </p>

                        </div>
                    </div> -->

                <!--
                    <h1>SPRING 2015 TRIPS & ACTIVITIES</h1>
                    <div class="container events">
                        <div class="container container-ow container-sm-height">

                            <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-2 col-sm-height" style="background-image:url(../img/events/dresden.jpg);">
                                <span class="day">Saturday<br>March<br><strong>7th</strong></span>
                                <h2>Trip to Dresden</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>
                                    Do you also think it's been a long while since the Orientation Week trips and it's already time for another one? We would like to invite you to go with us to Germany and visit Dresden, the capital of Saxony! This amazing city, which was almost completely destroyed during WWII and rebuilt again, is also called "Florence on the Elbe", thanks to its idyllic location on the banks of the Elbe river and its excellent examples of Baroque architecture and world-class museums. The most notable places are Residenzschloss, Brühlsche Terasse, Frauenkirche, Fürstenzug, Zwinger Palace, Semper Opera etc.
                                </p>
                                <p>
                                    We are also going to visit Volkswagen Transparent Factory, where the luxury sedan Phaeton is assembled.
                                </p>

                                <p>
                                    <b>Price:</b> 1200 CZK
                                </p>
                                <p>
                                    Registrations are opened you can pay in the ESN Point.
                                </p>
                                <p>
                                ► <a href="https://www.facebook.com/events/778149378942583">More info in Facebook event</a>
                                </p>
                            </div>
                        </div>

                        </div>
                    </div>
                -->
                <!--
                <h1>FALL 2014 TRIPS & ACTIVITIES</h1>

                <div class="container events">
                    <div class="container container-ow container-sm-height">


                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-5 col-sm-height" style="background-image:url(../img/events/trip_vienna.jpg);">
                                <span class="day">October<br><strong>31st-</strong><br>November<br><strong>2nd</strong></span>
                                <h2>Megatrip</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>Are you serious about traveling? Do you want to join our partybus and see three countries in one weekend? Then read on: ESN is going to show you Brno, Bratislava and Vienna all in one adventurous trip! See the capitals of central Europe: their beautiful cultural heritage during the day and their drinking habits during the night!</p>
                            </div>
                        </div>
                        <span class="vspace"></span>
                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-1 col-sm-height" style="background-image:url(../img/events/paintball.jpg);">
                                <span class="day">Saturday<br>November<br><strong>8th</strong></span>
                                <h2>Paintball</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>Come and join us for a spectacular ESN battle where your adrenaline will rise, but your safety will not be threatened. Where nationalities and friendships do not matter. Where your enemies are your friends and friends are your enemies. No previous experience required.</p>
                                </p>
                            </div>
                        </div>
                        <span class="vspace"></span>
                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-2 col-sm-height" style="background-image:url(../img/events/snezka_sunrise.jpg);">
                                <span class="day">November<br><strong>14th-16th</strong></span>
                                <h2>Sněžka Sunrise</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>
                                This trip is for adventurous people. It's a trip to the beautiful nature of Krkonoše. Its main goal is to get to the highest mountain in the Czech Republic – Sněžka. But it's not just an ordinary hike. We will go up the mountain at night to get there when the sun rises. Other than the amazing view of the rising sun over the country, you can expect a lot of fun, amazing people and maybe even some drinking. :)
                                </p>
                            </div>
                        </div>
                        <span class="vspace"></span>
                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url(../img/events/laser_tag.jpg);">
                                <span class="day">Saturday<br>November<br><strong>22nd</strong><br>5:20 pm</span>
                                <h2>Laser Game</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>
                                Imagine being fully equipped with a high-tech phaser and vest, entering a futuristic world somewhere in the galaxy. Whoever said laser tag is boring clearly never played it with a bunch on internationals! Laser tag is a great game that makes your experience anything but ordinary. Come with ESN to experience that for yourself!
                                </p>
                            </div>
                        </div>
                        <span class="vspace"></span>
                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-2 col-sm-height" style="background-image:url(../img/events/krakow.jpg);">
                                <span class="day">November<br><strong>27th-<br>30th</strong></span>
                                <h2>Krakow Trip</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>
                                Have you ever seen a salt mine? Have you ever been to a concentration camp? Have you been partying all weekend long with 50 other exchange students in Krakow? No? ESN (CTU) and Buddy System (VŠE) together organize a trip just for you!
                                </p>
                            </div>
                        </div>

                        <span class="vspace"></span>
                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-4 col-sm-height" style="background-image:url(../img/events/metro_stop_game.jpg);">
                                <span class="day">Saturday<br>December<br><strong>6th</strong></span>
                                <h2>Metro Stop Game</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">
                                <p>
                                If you ask yourself what the hell is that, wait no more. This is the best game you can play in Prague. We go the green line of Prague subway from Depo Hostivař to Dejvická. But at each stop we get out to a pub and drink a beer. The first to get to Dejvická wins a great prize. Don't worry, we play it in teams and girls can drink small beers. So if you like this challenge, get Czeched, drink some beers and come play with us.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>


                <center>
                Some other events you can await this semester, but we don't have any date for yet, are Laser tag and Ice skating.
                </center>
            -->

            </div>
            --}}
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
@endsection
