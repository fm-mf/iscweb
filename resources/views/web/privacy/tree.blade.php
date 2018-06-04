{{--/**
 * Created by PhpStorm.
 * User: mobil
 * Date: 18/05/2018
 * Time: 20:51
 */--}}
@extends('web.layouts.subpage')
@section('wrapper-class', 'about-wrapper')
@section('navClass', 'navbar-dark')
@section('title', 'Privacy')
@section('titleClass','title-privacy')

@section('content')

    <div class="container subpage">
        <div class="row vision">
            <div class="col-sm-6">
                <p><a href="{{ url('privacy/notice') }}">Privacy notice</a> for all incoming students</p>
                <p><a href="{{ url('privacy/policy') }}">Privacy policy</a> for registered members</p>
            </div>
            <div class="col-sm-6">
                <p><a href="{{ url('privacy/agreements-cs') }}">Souhlas se zpracováním osobních údajů</a> pro české Buddíky</p>
            </div>
        </div>
    </div>
@endsection
