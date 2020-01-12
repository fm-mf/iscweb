@extends('web.layouts.layout')

@section('title', 'Survival Guide')

@section('header')
    <div class="header-wrapper guide-wrapper">
        <header>
            @include('web.layouts.navigation')
            <h1>Survival Guide</h1>
        </header>
    </div>
@endsection

@section('page')

<div class="guide-content">
    <div class="home-screen">
        <div class="guide-navigation">
            <ul class="list-unstyled row">
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'introduction']) }}" id="link-aya">First steps</a></li>
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'academic-year']) }}" id="link-sac">CTU &amp; Useful information</a></li>
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'visa']) }}" id="link-lip">Czech it out!</a></li>
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'isc-intro']) }}" id="link-esn">ISC &amp; ESN</a></li>
            </ul>
        </div>

        <img src="{{ $president['avatar'] }}" class="img-circle" alt="">
        <p>
            Dear international students,<br />welcome to the Czech Republic and to the Czech Technical University&#x21;<br /><br />
            Whether you are an Erasmus student, an Exchange student, an Erasmus Mundus student or a self-paying &#x28;private&#x29; student, we hope you will have a great time&#x21;<br /><br />
            Maybe you are not aware of it yet, but you are the luckiest people in the world. Your study stay is just starting, and you can explore a brand new world&#x21; Try to get the best from your stay here&#x21; Let me introduce the International Student Club. ISC is a bunch of volunteers who do not hesitate to help other students. We do this in our leisure time – we want to meet international people, make friends, we want to learn foreign languages, we want to grow personally and much more. We strive to be the best in our field.<br /><br />
            There are hundreds of incoming international students this semester. Please, keep in mind that the buddy program is a voluntary service. If you need help or advice, ask your Czech Buddy or come to the ISC point, and we will try to help.
            <br /><br />
            Together we conquer the world&#x21;
        </p>
        <p>{{ $president['name'] }}<br>
            President of the {{ $fullName }}
        </p>
    </div>
</div>

@stop

<!--
        <div class="navigation">
            <ul class="list-unstyled row">
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'introduction']) }}" id="link-aya">First steps</a></li>
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'academic-year']) }}" id="link-sac">CTU &amp; Useful information</a></li>
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'visa']) }}" id="link-lip">Czech it out!</a></li>
                <li class="col-sm-3"><a href="{{ action('Guide\PageController@showPage', ['page' => 'isc-intro']) }}" id="link-esn">ISC &amp; ESN</a></li>
            </ul>
        </div>
-->
