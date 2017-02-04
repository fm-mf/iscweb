@extends('web.layouts.subpage')
@section('wrapper-class', 'about-wrapper')
@section('navClass', 'navbar-light')
@section('title', 'Buddy Program')

@section('content')

    <h1 class="s-title">Our goal is to find a buddy for every one of you.</h1>

    <div class="container subpage">


        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">

                <p class="spaced bigger">
                    Are you coming to Prague to spend your study abroad at the Czech Technical University? Are you a bit afraid before coming here since you don't know Czech language nor anyone in Prague? You don't need to worry, because <strong>you&nbsp;will&nbsp;have&nbsp;a&nbsp;Buddy</strong>!
                </p>
            </div>
        </div>
        <ul class="row list-unstyled info-buddy">
            <li class="col-sm-4">
                <img src="{{ asset('img/web/laptop.jpg') }}">
                <p>Your buddy will contact you by email a couple of weeks before the semester starts.</p>
                <!-- <p>Please, fill out your arrival information after you get access to our buddy system (will be sent to you by email).</p> -->
            </li>
            <li class="col-sm-4">
                <img src="{{ asset('img/web/airport-hug.jpg') }}">
                <p>
                    Your buddy will pick you up at the airport (or station) and will help you with the accommodation in your dormitory.
                </p>
            </li>
            <li class="col-sm-4">
                <img src="{{ asset('img/web/bridge.jpg') }}">
                <p>
                    Not only will your buddy show you around, but he or she might also take you to his or her favorite pub and teach you how to drink Czech beer :)
                </p>
            </li>

        </ul>
        <h1>We are Volunteers.</h1>
        <p class="align-center">We'll do our best to help you out. But, please, keep in mind that we do it in our free time. Treat us as friends, not as servants :)</p>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 link-buddies">
                <p class="light-bg">Are you a <strong>Czech student</strong> wishing to take part in the Buddy Program? Then follow
                    <a href="{{ url('/buddy') }}"> <button type="button" class="btn btn-primary">THIS&nbsp;LINK</button></a>
                    to find more information for Czech Buddies.</p>

            </div>
        </div>
    </div>
@endsection