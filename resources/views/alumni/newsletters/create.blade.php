@extends('czech.layouts.layout')

@section('title', 'Alumni Newsletter')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/alumni.css') }}" />
@endsection

@section('page')
    <section id="newsletter-form">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Přidat Newsletter</h1>
                    <form method="POST" action="{{ route('alumni.newsletters.store') }}">
                        @include('alumni.partials.newsletter-form-fields')
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><span class="fas fa-plus"></span> Přidat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
