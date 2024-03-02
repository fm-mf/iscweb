@extends('web.layouts.layout')
@section('title', 'About us')

@section('header')
    <div class="header-wrapper about-us">
        <header>
            @include('web.layouts.navigation')
            <h1>About us</h1>
        </header>
    </div>
@endsection

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <p>The <strong>HISTORY</strong> of our student organization goes back to 1999 when two Czech students returned from their study exchange in the USA and in cooperation with International Office at CTU established the Erasmus Student Network and started our core activity &ndash; Buddy Program.</p>

                    <p>Since then <strong>OUR VISION</strong> has been to <strong>create an international community</strong> at the Czech Technical University in Prague. We want to <strong>integrate exchange students</strong> into life in the Czech Republic and into events at our university. We create surroundings where different cultures meet and foreign and Czech students get to know each other.</p>
                    <p>We support the active involvement of our members, their self-realization and personal development  in a creative environment where there is a friendly and open atmosphere.</p>
                    <p>In this way <strong>we contribute to understanding, friendship and cooperation among the nations in Europe and throughout the world.</strong></p>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 book">
                    <h2>ISC Spirit book</h2>
                    <p>Our culture certainly stands on some values we all share. These values are crucially important to our organization and they
                        reflect the way we dream, work, cooperate and communicate. Learn more about our culture in our Spirit Book</p>
                    <p class="align-center">
                        <a href="{{ asset('files/iscCtuSpiritBook.pdf') }}" class="btn btn-outline-dark">
                            <span class="fas fa-file-pdf"></span> ISC Spirit book
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-7 col-lg-8">
                    <p>
                        Since 2003, <strong>{{ $fullName }}</strong> is a proud member of
                        <strong>ESN Czech Republic</strong>.
                    </p>
                    <p>
                        <strong>Erasmus Student Network</strong> (ESN) is the biggest student association in Europe.
                        It was born on 16 October 1989 and legally registered in 1990 for supporting and developing
                        student exchange. It is present in more than 900 higher education institutions from 40 countries.
                        The network is constantly developing and expanding. We have around 15 000 active members that are
                        in many sections supported by so called buddies taking care of international students. Thus,
                        ESN involves around 40 000 young people offering its services to around 220 000 international
                        students every year.
                    </p>
                </div>
                <div class="col-sm-6 col-md-5 col-lg-4 d-flex flex-column justify-content-around">
                    <div class="row">
                        <div class="col-8 col-sm-10 col-xl-8 ml-auto mr-auto">
                            <a href="https://www.esncz.org">
                                <img src="/img/logos/esn-cz/esn-cz-logo-colour.svg" alt="Logo ESN CZ" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
