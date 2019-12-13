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
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="required" for="newsletter-title">Titulek</label>
                            <input class="form-control @if ($errors->has('title')) is-invalid @endif" type="text" name="title" id="newsletter-title" required="required" value="{{ request()->old('title') }}" />
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="newsletter-link">Odkaz</label>
                            <input class="form-control @if ($errors->has('link')) is-invalid @endif" type="url" name="link" id="newsletter-link" required="required" value="{{ request()->old('link') }}" />
                            @if($errors->has('link'))
                                <div class="invalid-feedback">{{ $errors->first('link') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="newsletter-perex">Úvod</label>
                            <textarea class="form-control @if ($errors->has('perex')) is-invalid @endif" type="text" name="perex" id="newsletter-perex">{{ request()->old('perex') }}</textarea>
                            @if($errors->has('perex'))
                                <div class="invalid-feedback">{{ $errors->first('perex') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="required" for="newsletter-date">Datum odeslání</label>
                            <input class="form-control @if ($errors->has('date_sent')) is-invalid @endif" type="date" name="date_sent" id="newsletter-date" required="required" value="{{ request()->old('date_sent') ?? \Carbon\Carbon::now()->toDateString() }}" />
                            @if($errors->has('date_sent'))
                                <div class="invalid-feedback">{{ $errors->first('date_sent') }}</div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><span class="fas fa-plus"></span> Přidat</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
