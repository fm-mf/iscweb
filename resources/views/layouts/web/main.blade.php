@extends('layouts.web.layout')
@section('page')
<div class="header-wrapper">
    @include('layouts.web.navigation')
    <p class="scroll-down"><a href="#" id="scroll">scroll down to see upcoming events <br> <span class="glyphicon glyphicon-chevron-down" style="font-size:20px;"></span></a></p>

    <div class="container circles center">
        <div class="row">
            <div class="circ-info col-sm-4">
                <a href="http://isc.cvut.cz/guide">
                    <img src="{{ URL::asset('img/web/circle-1.png') }}" alt="Before Arrival">

                    <h2>BEFORE ARRIVAL</h2>
                    <p>We provide relevant information to incoming exchange students</p>
                    <button type="button" class="btn btn-default btn-lg btn-circles">Go to the Survival Guide</button>
                </a>
            </div>
            <div class="circ-info circ-info-fright col-sm-4">
                <a href="{{ url('buddy-program') }}">
                    <img src="{{ URL::asset('img/web/circle-2.png') }}" alt="Buddy Program">
                    <h2>BUDDY PROGRAM</h2>
                    <p>We pair Czech and exchange students</p>
                    <button type="button" class="btn btn-default btn-lg btn-circles">Learn more</button>
                    <a href="https://www.isc.cvut.cz/buddy" class="for-czechs">
                        <img src="{{ URL::asset('img/web/czech-flag.png') }}" alt="For Czech Students">Information for Czech students</a>
                </a>
            </div>
            <div class="circ-info col-sm-4">
                    <a href="{{ url('/activities') }}">
                        <img src="{{ URL::asset('img/web/circle-3.png') }}" alt="Activities & Events">
                        <h2>ACTIVITIES AND EVENTS</h2>
                        <p>We organize language programs, country presentations, trips, sports and many other activities</p>
                        <button type="button" class="btn btn-default btn-lg btn-circles">See our activities</button>
                    </a>
            </div>
        </div>
        <span class="show-menu"></span>
        <div class="row">
            <h1 class="introduction clearfix">THIS IS HOW WE INTEGRATE EXCHANGE STUDENTS INTO LIFE IN THE CZECH REPUBLIC <br> <small>& create surroundings where different cultures meet and foreign and Czech students get to know each other</small></h1>
        </div>
    </div>

    <div class="logos">
        <div class="container">
            <a href="http://www.esn.org"><img src="{{ URL::asset('img/web/logo-esn.png') }}"></a>
            <a href="http://www.cvut.cz"><img src="{{ URL::asset('img/web/logo-ctu.png') }}"></a>
        </div>
    </div>
</div>
@yield('content')
@endsection