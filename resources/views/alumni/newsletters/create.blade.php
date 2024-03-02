@extends('czech.layouts.layout')

@section('title', 'Přidat – Newsletter – Alumni')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/alumni.css') }}" />
@endsection

@section('page')
    <section id="newsletter-form">
        <div class="container">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('czech.index') }}">ESN</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('alumni.index') }}">Alumni</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('alumni.newsletters.index') }}">Archiv Newsletterů</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Přidat nový Newsletter</li>
                        </ol>
                    </nav>
                </div>
            </div>
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
