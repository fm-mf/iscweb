@extends('partak.users.layout')
@section('inner-content')
    @if (session('removeSuccess'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('removeSuccess') }}
                </div>
            </div>
        </div>
    @endif
    @include('partak.users.exStudent-Buddy_ Bubles', ['buddyRemovable' => true])
    <div class="">
        <div class="row row-inner">
            <div class="col-sm-8">
                <label for="unique_url">Unique URL</label>
                <div class="input-group">
                    <span class="input-group-addon" id="url"><span class="glyphicon glyphicon-link"></span> </span>
                    <input type="text" id="unique_url" class="form-control" value="{{ url('/exchange/'). '/' . $exStudent->person->user->hash }}" aria-describedby="url" readonly="">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-duplicate"></span> </button>
                      </span>
                </div><!-- /input-group -->
            </div>
        </div>
    </div>

    @include('partak.users.exStudentDetailTable')
@stop