@extends('czech.layouts.layout')

@section('title', 'Upravit – Newsletter – Alumni')

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
                            <li class="breadcrumb-item"><a href="{{ route('czech.index') }}">ISC</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('alumni.index') }}">Alumni</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('alumni.newsletters.index') }}">Archiv Newsletterů</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Upravit „{{ $newsletter->title }}“</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>Upravit Newsletter</h1>
                    <form method="POST" action="{{ route('alumni.newsletters.update', $newsletter) }}">
                        {{ method_field('PATCH') }}
                        @include('alumni.partials.newsletter-form-fields', ['newsletter' => $newsletter])
                        <div class="form-group">
                            <a class="btn btn-outline-secondary" href="{{ url()->previous() === url()->current() ? route('alumni.newsletters.index') : url()->previous() }}"><span class="fas fa-times"></span> Zrušit</a>
                            <button class="btn btn-primary" type="submit"><span class="fas fa-pen"></span> Upravit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
