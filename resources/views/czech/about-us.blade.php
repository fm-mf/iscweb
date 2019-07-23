@extends('czech.layouts.layout')
@section('navClass', 'navbar-dark')
@section('page')
    <div class="about-wrapper">
        <h1 class="title "><strong>O N&Aacute;S</strong></h1>
    </div>
    <div class="container subpage">
        <div class="row vision">
            <div class="col-sm-7">
                <p>The <strong>HISTORY</strong> of our student organization goes back to 1999 when two Czech students returned from their study exchange in the USA and in cooperation with International Office at CTU established the International Student Club and started our core activity &ndash; Buddy Program.</p>

                <p>Since then <strong>OUR VISION</strong> has been to <strong>create an international community</strong> at the Czech Technical University in Prague. We want to <strong>integrate exchange students</strong> into life in the Czech Republic and into events at our university. We create surroundings where different cultures meet and foreign and Czech students get to know each other.</p>
                <p>We support the active involvement of our members, their self-realization and personal development  in a creative environment where there is a friendly and open atmosphere.</p>
                <p>In this way <strong>we contribute to understanding, friendship and cooperation among the nations in Europe and throughout the world.</strong></p>
            </div>
            <div class="col-sm-5 book">
                <h2>ISC SPIRIT BOOK</h2>
                <p>Our culture certainly stands on some values we all share. These values are crucially important to our organization and they
                   reflect the way we dream, work, cooperate and communicate. Learn more about our culture in our Spirit Book</p>
                <p class="align-center">
                    <a href="{{ URL::asset('files/iscCtuSpiritBook.pdf') }}">
                        <button type="button" class="btn btn-default btn-lg">St&aacute;hnout jako PDF</button>
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
