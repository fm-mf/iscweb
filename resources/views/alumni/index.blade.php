@extends('czech.layouts.layout')

@section('title', 'Alumni')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/alumni.css') }}" />
@endsection

@section('page')
    <section id="newsletter-sign-up">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('czech.index') }}">ESN</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Alumni</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>
                        Archiv Newsletterů
                    </h1>
                    <p><a href="{{ route('alumni.newsletters.index') }}">Zobrazit minulé Newslettery</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @include('alumni.partials.mailchimp-alumni-sign-up-form')
                </div>
            </div>
        </div>
    </section>
@endsection
