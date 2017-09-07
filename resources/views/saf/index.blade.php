@extends('layouts.saf.layout')

@section('lang', 'cs')

@section('page')
    @include('saf.landing-page')
    @include('saf.about')
    {{--@include('saf.presentations')--}}
    @include('saf.partners')
    {{--@include('saf.exchange-programmes')--}}
@endsection

@section('scripts')
    @parent
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="/js/saf/saf.js"></script>
@endsection