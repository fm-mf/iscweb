@extends('czech.layouts.layout')

@section('title', 'Alumni Newsletter')

@section('stylesheets')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ mix('css/alumni.css') }}" />
@endsection

@section('page')
    <section id="newsletters-list">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Archiv Newsletterů</h1>
                </div>
            </div>
            @if (session('success'))
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success">{{ session('success') }}</div>
                    </div>
                </div>
            @endif
            @if ($errors->any())
                <div class="row">
                    <div class="col">
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    </div>
                </div>
            @endif
            @can('acl', 'alumniNewsletter.create')
                <div class="row">
                    <div class="col">
                        <a href="{{ route('alumni.newsletters.create') }}" class="btn btn-primary"><span class="fas fa-plus"></span> Přidat Newsletter</a>
                    </div>
                </div>
            @endcan
            <div class="row">
                <div class="col">
                    @if($newsletters->count() === 0)
                        <p><strong>Ještě tu nejsou žádné Newslettery</strong></p>
                    @else
                        <ul class="list-unstyled">
                            @foreach($newsletters as $newsletter)
                                <li>
                                    @include('alumni.partials.newsletter-list-item', $newsletter)
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
