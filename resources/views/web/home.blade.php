@extends('web.layouts.layout')

@section('header')
    <div class="header-wrapper home">
        <header>
            @include('web.layouts.navigation')

            @if($coronavirusEnabled)
            <div class="coronavirus-alert">
                Regularly updated information about coronavirus (COVID-19) situation can be found <a href="{{ route('coronavirus') }}">here</a>
            </div>
            @endif


            <p class="scroll-down">
                <a href="#upcoming-events" class="link link-more" id="scroll">
                    Scroll down to see upcoming events
                    <span class="fas fa-chevron-down fa-lg"></span>
                </a>
            </p>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 circ-info">
                        <div class="img-wrapper">
                            <img src="{{ asset('img/web/before-arrival.jpg') }}" />
                        </div>
                        <h3>Before arrival</h3>
                        <p>We provide relevant information to incoming exchange students</p>
                        <a class="btn btn-outline-light btn-lg" href="{{ route('guide') }}">Go to Survival guide</a>
                    </div>
                    <div class="col-md-4 circ-info">
                        <div class="img-wrapper">
                            <img src="{{ asset('img/web/buddy-beer.jpg') }}" />
                        </div>
                        <h3>Buddy program</h3>
                        <p>We pair Czech and exchange students</p>
                        <a class="btn btn-outline-light btn-lg" href="{{ route('web.buddy-program') }}">Learn more</a>
                    </div>
                    <div class="col-md-4 circ-info">
                        <div class="img-wrapper">
                            <img src="{{ asset('img/web/activities.jpg') }}" />
                        </div>
                        <h3>Activities & Events</h3>
                        <p>We organise language programs, country presentations, trips, sports and many other activities</p>
                        <a class="btn btn-outline-light btn-lg" href="{{ route('web.activities.index') }}">See our activities</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <p class="introduction">
                            This is how we integrate exchange students into life in the Czech Republic
                            <small>
                                &amp; create surroundings where different cultures meet and foreign and Czech students get to know each other
                            </small>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-items-stretch align-content-center logos">
                <div class="col-auto">
                    <a href="https://www.esn.org" class="logo" target="_blank" rel="noopener">
                        <img src="{{ asset('img/logos/esn/esn-logo-white.svg') }}" alt="Logo of the Erasmus Student Network" />
                    </a>
                    <a href="https://www.cvut.cz/en" class="logo logo-cvut" target="_blank" rel="noopener">
                        <img src="{{ asset('img/logos/cvut/logo_cvut_en_doplnkova_verze_negativ.svg') }}" alt="Logo of the Czech Technical University in Prague" />
                    </a>
                </div>
            </div>
        </header>
    </div>
@endsection

@section('page')
    <section id="upcoming-events">
        <div class="container">
            <h1>Upcoming events</h1>
            @if(isset($events) && $events->count() > 0)
                <ul class="list-unstyled events">
                    @foreach($events as $event)
                        @include('partials.calendar-event', compact('event'))
                    @endforeach
                </ul>
            @else
                <p>There are no upcoming events. Wait for the next semester ;-)</p>
            @endif

            @if($more)
                <p>You can find more upcoming events in <a href="{{ route('web.calendar') }}">Calendar</a></p>
            @endif
        </div>
    </section>
    <section id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>See what past exchange students said about us</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('img/web/sergio.jpg') }}" alt="Sergio Martín" />
                        </div>
                        <div class="col-md-8">
                            <p>I have a lot of good memories of the Czech Technical University (CTU), but the first thing I have to emphasize is the Erasmus Student Network (ESN). Due to the nice and friendly atmosphere I could feel since the beginning.</p>
                            <p>I decided to help them with the organization of some activities like the orientation week, language meetings, sport events or trips. I’ve also been teaching my Spanish language to other students!</p>
                            <p>It has been an unbelievable experience for me that I recommend to every Erasmus student for sure!</p>
                            <p><strong>Sergio Martín</strong>, Spain</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('img/web/mikel.jpg') }}" alt="Mikel Ogueata" />
                        </div>
                        <div class="col-md-8">
                            <p>Joining ESN CTU in Prague allowed me many things. At the beginning of the semester, it helped me with getting to know new people from all over the world. I started learning German (with a very nice teacher) in the Masarykova dormitory, I discovered lots of new places in Prague by attending the Café Lingea meetings, where my language skills were tested, and I learned to play voleyball.</p>
                            <p>I still keep many friends who I have visited/hosted after my Erasmus. That's one of the things I am most proud of &ndash; to be able to keep these friendships through time.</p>
                            <p>My advice for those starting an Erasmus is clear: Join ESN as soon as you get there, you won't regret it.</p>
                            <p><strong>Mikel Ogueta</strong>, Spain</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
