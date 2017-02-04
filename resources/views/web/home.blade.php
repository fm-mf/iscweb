@extends('web.layouts.main')
@section('content')

    <div id="events"></div>
    <div class="wrapper">

        <div class="modal fade" id="logo-download">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ URL::asset('img/web/logo-circle.png') }}" alt="ISC Logos">
                        <h2>DOWNLOAD OUR LOGOS</h2>
                        <p>Zip file packed with our logo in PDF and PNG format.</p>
                        <a href="http://isc.cvut.cz/files/isc-logos.zip"> <button type="button" class="btn btn-primary btn-logo">DOWNLOAD LOGOS</button></a>
                    </div>
                </div>
            </div>
        </div>

        <!--
        <h1>UPCOMING EVENTS</h1>
        -->
        <!--
        <div class="container events">
            <div class="container container-ow container-sm-height">
                <div class="row row-ow row-sm-height">
                    <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/ow/ow_fel.jpg);">
                        <span class="day">February<br><strong>15th-<br>21st</strong></span>
                        <h2>Orientation Week<br>Spring 2016</h2>
                    </div>
                    <div class="col-sm-6 ow-detail col-sm-height col-top">
                        <p>
                        Like every semester, we are going to organize the Orientation Week for all incoming exchange students. During this week, we will provide you with all the important information regarding studying at CTU, we will help you get to know Prague and also each other and we will introduce you to the International Student Club. Registrations at faculties also take place in this week. The second part of the week is dedicated to trips to interesting places all around the Czech Republic.
                        </p>
                        <p>
                        The Orientation Week is for free (except for the trips) and no registration is needed.
                        </p>
                        <p>
                        We are looking forward to meeting you in Prague!
                        </p>
                        <p>
                        <i>More information will come soon.</i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        -->

        <!--------------------- Orientation week ----------------------------------------------------

        <!-- ------------------------ OW Fall 2016 --------------------------------------------------------- -->

        <div class="container events">
            <div class="container container-ow container-sm-height">

                <!-- ------------------------ div containery prosím nechat --------------------------------------------------------- -->
                <h1>There are no UPCOMING EVENTS. Wait for the next semester ;-)</h1>

                <!-- ------------------------ div containery prosím nechat --------------------------------------------------------- -->
            </div>
        </div>

        <!------------------------------ VZOR EVENT --------------------------------------------
                <span class="vspace"></span>
                <div class="row row-ow row-sm-height">
                    <div class="col-sm-6 ow-day col-sm-height" style="background-image:url(../img/events/christmas_feast1.jpg);">
                        <span class="day">Wednesday<br>February<br><strong>24th</strong></span>
                        <h2>Christmas Feast</h2>
                    </div>
                    <div class="col-sm-6 ow-detail col-sm-height col-top">
                        <p>
                            In ISC we realize that no-one wants to be alone during this festive time and as we believe in the saying “the more the merrier,” we would like to invite you to spend a proper Czech Christmas evening with us.
                        </p>
                        <p>
                            You arrived to the country with the most beautiful girls in the world and cheap, good beer. That is what most people would say about Czech Republic if you they were asked to. But do you know anything else about the country where are you going to spend a few months? Come to the Czech presentation to find out more! inteGREAT is more than a party
                        </p>
                        <p>

                            <b>Registration?</b> come to <a href="https://goo.gl/maps/OCtHW">ISC Point (R304)</a> and pay there
                            <br>
                            <b>Price?</b> 70 CZK
                        </p>

                        <p>
                            <b>Where?</b> <a href="https://goo.gl/maps/OCtHW">Masarykova dormitory (R404)</a>
                            <b>When?</b> at 7 pm
                        </p>


                        <p>

                            ► <a href="https://www.facebook.com/events/1130686593608143/">Facebook event</a>
                        </p>

                    </div>
                </div>
        -->


        <!-- ---------------tlačítko do kalenáře, když je hodně eventů------------------>
        <!--
        <span class="vspace"></span>
        <p class="align-center" style="padding-top:20px;"><a n:href="calendar:"> <button type="button" class="btn btn-primary">See all upcoming events in Calendar</button></a></p>
       -->

        <!--
        </div>


        -->

        <!--
                <div class="col-sm-4">
                    <h2>Friday, September 25</h2>
                    <p class="align-center"><img src="img/event.jpg" alt="Event picture"></p>
                    <h2 class="event-title">inteGREAT's Winetasting party</h2>
                    <p>Did you know that in ancient Egypt the ability to store wine until maturity was considered alchemy and was the privilege of only the pharaohs? That wine used to be so valuable the Greeks traded wine for precious metals and the Romans traded wine for slaves?</p>
                    <a href="" class="more-info">More info</a>
                </div>
                <div class="col-sm-4">
                    <h2>Friday, September 25</h2>
                    <p class="align-center"><img src="img/event.jpg" alt="Event picture"></p>
                    <h2 class="event-title">inteGREAT's Winetasting party</h2>
                    <p>Did you know that in ancient Egypt the ability to store wine until maturity was considered alchemy and was the privilege of only the pharaohs? That wine used to be so valuable the Greeks traded wine for precious metals and the Romans traded wine for slaves?</p>
                    <a href="" class="more-info">More info</a>
                </div>
            </div>
        </div>
        -->
        <!--------------------- About us ---------------------------------------------------->
        <div class="container-fluid about" id="about-us">
            <div class="row">
                <h2><strong>ABOUT US</strong></h2>
            </div>
        </div>
        <div class="container">
            <div class="row vision">
                <div class="col-sm-7">
                    <p><big>OUR VISION</big> is to create an international community at the Czech Technical University in Prague. We want to integrate exchange students into life in the Czech Republic and into events at our university. We create surroundings where different cultures meet and foreign and Czech students get to know each other.</p>
                    <p>We support the active involvement of our members, their self-realization and personal development  in a creative environment where there is a friendly and open atmosphere.</p>
                    <p>In this way <strong>we contribute to understanding, friendship and cooperation among the nations in Europe and throughout the world.</strong></p>
                </div>
                <div class="col-sm-5 book">
                    <h2>ISC SPIRIT BOOK</h2>
                    <p>Our culture certainly stands on some values we all share. These values are crucially important to our organization and they
                        reflect the way we dream, work, cooperate and communicate. Learn more about our culture in our Spirit Book</p>
                    <p class="align-center">
                        <a href="{{ URL::asset('files/iscCtuSpiritBook.pdf') }}">
                            <button type="button" class="btn btn-default btn-lg">Download as PDF</button>
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!--------------------- Testimonials ---------------------------------------------------->
        <div class="testimonials-wrap">
            <div class="container testimonials">
                <h1>SEE WHAT PAST EXCHANGE STUDENTS SAID ABOUT US</h1>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4 testimonials-img"><img src="{{ URL::asset('img/web/sergio.jpg') }}" alt="Sergio Martín"></div>
                        <div class="col-sm-8">
                            <p>I have a lot of good memories of the Czech Technical University (CTU), but the first thing I have to emphasize is the International Student Club (ISC). Due to the nice and friendly atmosphere I could feel since the beginning.</p>
                            <p>I decided to help them with the organization of some activities like the orientation week, language meetings, sport events or trips. I’ve also been teaching my Spanish language to other students!</p>
                            <p>It has been an unbelievable experience for me that I recommend to every Erasmus student for sure!</p>
                            <p><strong>Sergio Martín</strong>, Spain</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-4 testimonials-img"><img src="{{ URL::asset('img/web/mikel.jpg') }}" alt="Mikel Ogueata"></div>
                        <div class="col-sm-8">
                            <p>Joining ISC CTU in Prague allowed me many things. At the beginning of the semester, it helped me with getting to know new people from all over the world. I started learning German (with a very nice teacher) in the Masarykova dormitory, I discovered lots of new places in Prague by attending the Café Lingea meetings, where my language skills were tested, and I learned to play voleyball.</p>
                            <p>I still keep many friends who I have visited/hosted after my Erasmus. That's one of the things I am most proud of &ndash; to be able to keep these friendships through time.</p>
                            <p>My advice for those starting an Erasmus is clear: Join ISC as soon as you get there, you won't regret it.</p>
                            <p><strong>Mikel Ogueta</strong>, Spain</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection