@extends('partak.trips.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="row">
            <div class="row-inner">
                <div class="success">
                    <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> Profile was successfully updated.
                </div>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row row-inner" id="form">
            <div class="col-md-7">
                <h2>Create trip</h2>
                {{ Form::model($event, ['url' => 'partak/trips/create', 'method' => 'patch', 'id' => 'form', 'files' => true]) }}
                @include('partak.trips.editForm',['trips' => true])

                {{ Form::bsSubmit('Create trip') }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

