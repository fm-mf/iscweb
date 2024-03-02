@extends('web.layouts.layout')

@section('title', 'Survival Guide')

@section('header')
    <div class="header-wrapper guide guide-home">
        <header>
            @include('web.layouts.navigation')
            <div class="container">
                <h1>Survival Guide</h1>
                <nav class="guide-navigation">
                    <ul class="row list-unstyled">
                        <li class="col-md-3"><a href="{{ route('guide-page', ['page' => 'introduction']) }}" id="link-aya">First steps</a></li>
                        <li class="col-md-3"><a href="{{ route('guide-page', ['page' => 'academic-year']) }}" id="link-sac">CTU &amp; Useful information</a></li>
                        <li class="col-md-3"><a href="{{ route('guide-page', ['page' => 'visa']) }}" id="link-lip">Czech it out!</a></li>
                        <li class="col-md-3"><a href="{{ route('guide-page', ['page' => 'esn-ctu-intro']) }}" id="link-esn">ESN</a></li>
                    </ul>
                </nav>
            </div>
        </header>
    </div>
@endsection

@section('page')

<div class="container text-left guide-home-page">
    <img src="{{ $president['avatar'] }}" class="president-img" alt="Photo of ESN CTU President" />
    <p>
        Dear international students,<br />
        welcome to the Czech Republic and to the Czech Technical University in Prague!
    </p>
    <p>
        Whether you are an Erasmus student, an Exchange student, an Erasmus Mundus student,
        or a degree student, we hope you will have a great time!
    </p>
    <p>
        Maybe you are not aware of it yet, but you are the luckiest people in the world.
        Your study stay is just starting, and you can explore a brand new world!
        Try to get the best from your stay here! Let me introduce the {{ $fullName }}.
        <abbr title="{{ $fullName }}">ESN CTU</abbr> is a bunch of volunteers who do not hesitate
        to help other students. We do this in our leisure time – we want to meet international people,
        make friends, we want to learn foreign languages, we want to grow personally and much more.
        We strive to be the best in our field.
    </p>
    <p>
        There are hundreds of incoming international exchange students every semester.
        Please, keep in mind that the Buddy programme is a voluntary service.
        If you need help or advice, ask your Czech Buddy or come to the ESN Point,
        and we will try to help.
    </p>
    <p>
        <q class="font-italic">Together we conquer the world!</q>
    </p>
    <p>
        <strong>{{ $president['name'] }}</strong><br />
        <em>President of the {{ $fullName }}</em>
    </p>
</div>

@stop

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/guide.css') }}"/>
@endsection
