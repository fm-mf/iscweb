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
                        <img src="{{ asset('img/logos/isc-logo-watermark-color.svg') }}" alt="ISC Logos">
                        <h2>DOWNLOAD OUR LOGOS</h2>
                        <p>Zip file packed with our logo in SVG and PNG format.</p>
                        <a href="{{ asset('files/isc-logos-2019.zip') }}"><button type="button" class="btn btn-primary btn-logo">DOWNLOAD LOGOS</button></a>
                    </div>
                </div>
            </div>
        </div>
        <span class="vspace"></span>
        <div class="container events">
            <div class="container container-ow container-sm-height">

                @if(isset($events) && $events->count() > 0)
                    <h1>UPCOMING EVENTS</h1>
                    @foreach($events as $event)
                        <span class="vspace"></span>
                        <div class="row row-ow row-sm-height">
                            <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ url($event->cover()) }})">
                                <span class="day">{!! $event->calendarDateTimeFrom() !!}</span>
                                <h2>{{ $event->name }}</h2>
                            </div>
                            <div class="col-sm-6 ow-detail col-sm-height col-top">

                                {!! $event->description !!}

                                <p>
                                @if(isset($event->facebook_url) && $event->facebook_url != NULL)
                                    ► <a href="{{ $event->facebook_url }}"><strong>Facebook event!</strong></a>
                                @endif
                                @if ($event->reservations_enabled)
                                    ► <a href="{{ url("/event/{$event->reservations_hash}") }}"><strong>Online reservation!</strong></a>
                                @endif
                                </p>
                            </div>
                        </div>
                    @endforeach
{{--                @else--}}
{{--                    <h1>There are no UPCOMING EVENTS. Wait for the next semester ;-)</h1>--}}
                @endif

            </div>
            @if($more)<h2 style="text-align: center">You can find more upcoming events in <a href="{{ url('calendar') }}">Calendar</a></h2>@endif
        </div>
        <div class="container events">
            <div class="container container-ow container-sm-height trips-overview">
                <img src="{{ asset('img/web/events/trips-fall-2019.jpg') }}" alt="List of trips organised during the Fall 2019 semester" />
            </div>
        </div>

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
