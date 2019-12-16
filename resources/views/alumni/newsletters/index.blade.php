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
                        @can('acl', 'alumniNewsletter.delete')
                            <a href="{{ route('alumni.newsletters.deleted') }}" class="btn btn-outline-secondary"><span class="fas fa-recycle"></span> Odstraněné Newslettery</a>
                        @endcan
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
                                    @component('alumni.partials.newsletter-list-item', ['newsletter' => $newsletter])
                                        @slot('actionButtons')
                                            @can('acl', 'alumniNewsletter.update')
                                                <a class="btn btn-outline-primary" href="{{ route('alumni.newsletters.edit', $newsletter) }}"><span class="fas fa-pen"></span> Upravit</a>
                                            @endcan
                                            @can('acl', 'alumniNewsletter.delete')
                                                <form class="delete" method="POST" action="{{ route('alumni.newsletters.destroy', ['newsletter' => $newsletter]) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-outline-danger"><span class="fas fa-trash-alt"></span> Smazat</button>
                                                </form>
                                            @endcan
                                        @endslot
                                    @endcomponent
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
