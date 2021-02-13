@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="container">
            <div class="success top-message">
                <i class="fas fa-check mr-1"></i> {{ session('removeSuccess') }}
            </div>
        </div>
    @endif

    @include('partak.users.partials.exstudent-with-buddy', ['buddyRemovable' => true])

    <div class="container">
        <div class="row row-inner">
            <div class="col-sm-8">
                <label for="unique_url">Unique URL</label>
                <unique-url url="{{ url('/exchange/'). '/' . $exStudent->person->user->hash }}"></unique-url>
            </div>
        </div>
    </div>

    @include('partak.users.partials.exstudent-detail-table')
@stop