@extends('partak.users.layout')
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
                {{ Form::model($event, ['url' => 'partak/trips/edit/'. $event->id_event, 'method' => 'patch', 'id' => 'form']) }}
                {{ Form::bsText('name', 'Name') }}
                {{ Form::bsText('phone', 'Phone') }}

                <multiselectinput formName="organizers" title="organizers" :options="options.organizers" :value="options.sroles" :show-labels="false" label="title" track-by="id_user" placeholder="Organizers"
                                  :multiple="true"></multiselectinput>


            </div>
        </div>
    </div>
@stop