@extends('layouts.saf.layout')

@section('lang', 'cs')

@section('page')
    @include('layouts.saf.header')
@endsection

@section('stylesheets')
    <link href="{{ URL::asset('css/saf-partner.css') }}" rel="stylesheet" type="text/css" />
@show
