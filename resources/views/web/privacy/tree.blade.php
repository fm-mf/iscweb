@extends('web.layouts.layout')
@section('title', 'Privacy')

@section('page')
    <section id="privacy">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1>Privacy</h1>
                </div>
                <div class="col-md-6 col-lg-4 ml-lg-auto">
                    <p><a href="{{ url('privacy/notice') }}">Privacy notice</a> for all incoming students</p>
                    <p><a href="{{ url('privacy/policy') }}">Privacy policy</a> for registered members</p>
                </div>
                <div class="col-md-6 col-lg-4 mr-lg-auto">
                    <p><a href="{{ url('privacy/agreements-cs') }}">Souhlas se zpracováním osobních údajů</a> pro české Buddíky</p>
                </div>
            </div>
        </div>
    </section>
@endsection
