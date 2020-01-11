@extends('web.layouts.layout')
@section('title', 'Buddy program')

@section('header')
    <div class="header-wrapper buddy-program">
        <header>
            @include('web.layouts.navigation')
            <h1>Buddy program</h1>
        </header>
    </div>
@endsection

@section('page')
    <section >
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2>Our goal is to find a buddy for every one of you.</h2>
                    <p>
                        Are you coming to Prague to spend your study abroad at the Czech Technical University?
                        Are you a bit afraid before coming here since you don't know Czech language nor anyone in Prague?
                        You don't need to worry!
                    </p>
                </div>
            </div>
            <ul class="row list-unstyled">
                <li class="col-sm-9 col-md-6 col-lg-4 col-info mx-auto">
                    <img src="{{ asset('img/web/laptop.jpg') }}" />
                    <p>Your buddy will contact you by email a couple of weeks before the semester starts.</p>
                </li>
                <li class="col-sm-9 col-md-6 col-lg-4 col-info mx-auto">
                    <img src="{{ asset('img/web/airport-hug.jpg') }}" />
                    <p>
                        Your buddy will pick you up at the airport (or station) and will help you with the accommodation in your dormitory.
                    </p>
                </li>
                <li class="col-sm-9 col-md-6 col-lg-4 col-info mx-auto">
                    <img src="{{ asset('img/web/bridge.jpg') }}" />
                    <p>
                        Not only will your buddy show you around, but he or she might also take you to his or her favorite pub and teach you how to drink Czech beer :)
                    </p>
                </li>
            </ul>
            <p><strong>We are Volunteers.</strong></p>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <p><strong>We are doing our best to find a Buddy for every one of you.</strong></p>
                    <p>
                        Despite our best efforts it is not possible to get a Czech Buddy for everyone. Each semester we
                        have about 500 incoming exchange students and only 100 Buddies. About a month before you will
                        come to the Czech Republic, you will receive an e-mail with information about how to register to
                        our Buddy database and a unique link to create your profile (check the spam folder if you can't
                        find it).
                    </p>
                    <p>
                        A couple of weeks before the Orientation week starts we open the database for Czech students
                        to pick their incoming students. If you want to increase a chance to get a Buddy, fill in your
                        profile in time, add a picture and write a short interesting text about yourself.
                    </p>
                    <p>
                        <strong>
                            We'll do our best to help you out. But, please, keep in mind that we do it in our free time.
                            Treat us as friends, not as servants.
                        </strong>
                    </p>
                    <p>
                        Do you have any questions?
                    </p>
                    <p>
                        Check the <a href="{{ route('web.faq') }}">FAQ</a> section!
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
