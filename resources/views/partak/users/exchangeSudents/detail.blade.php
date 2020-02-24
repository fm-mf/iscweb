@extends('partak.users.layout')
@section('inner-content')

    @if (session('removeSuccess'))
        <div class="container">
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <i class="fas fa-check mr-1"></i> {{ session('removeSuccess') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @include('partak.users.exStudent-Buddy_Bubles', ['buddyRemovable' => true])
    <div class="container">
        <div class="row row-inner">
            <div class="col-sm-8">
                <label for="unique_url">Unique URL</label>
                <unique-url url="{{ url('/exchange/'). '/' . $exStudent->person->user->hash }}"></unique-url>
            </div>
        </div>
    </div>

    @include('partak.users.exStudentDetailTable')
@stop