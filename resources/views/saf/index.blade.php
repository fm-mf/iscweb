@extends('layouts.saf.layout')

@section('lang', 'cs')

@section('page')
    @include('saf.landing-page')
    @include('saf.about')
    @include('saf.harmonogram-saf')
    {{--@include('saf.presentations')--}}
    @include('saf.partners')
    @include('saf.student-presentations')
    {{--@include('saf.exchange-programmes')--}}
    @include('saf.chatbot')
    @include('saf.inspiration')
@endsection

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick-theme.css"/>
    @parent
@endsection

@section('scripts')
    @parent
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.0/slick/slick.min.js"></script>
    <script src="/js/saf/saf.js"></script>
@endsection