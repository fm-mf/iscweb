@extends('czech.layouts.layout')

@section('title', 'Alumni Newsletter')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/alumni.css') }}" />
@endsection

@section('page')
    <section id="newsletter-sign-up">
        <div class="container">
            <div class="row">
                <div class="col">
                    @include('alumni.partials.mailchimp-alumni-sign-up-form')
                </div>
            </div>
        </div>
    </section>
@endsection
