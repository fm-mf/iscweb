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
                    <h1>Odstraněné Newslettery</h1>
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
            <div class="row">
                <div class="col">
                    @if($deletedNewsletters->count() === 0)
                        <p><strong>Ještě tu nejsou žádné Newslettery</strong></p>
                    @else
                        <ul class="list-unstyled">
                            @foreach($deletedNewsletters as $newsletter)
                                <li>
                                    @component('alumni.partials.newsletter-list-item', ['newsletter' => $newsletter])
                                        @slot('actionButtons')
                                            <form class="restore" method="POST" action="{{ route('alumni.newsletters.restore', ['id' => $newsletter]) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('PATCH') }}
                                                <button type="submit" class="btn btn-outline-warning"><span class="fas fa-trash-restore-alt"></span> Obnovit</button>
                                            </form>
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
