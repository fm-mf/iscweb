@extends('partak.users.layout')
@section('inner-content')

    @if (session('removeSuccess'))
        <div class="container">
            <div class="row">
                <div class="row-inner">
                    <div class="success">
                        <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('removeSuccess') }}
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