@extends('partak.events.layout')
@section('inner-content')
    @if(session('eventDeleted'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {{ session('eventDeleted') }}
        </div>
    @endif

    <div class="row-grey">
        <div class="container">
            <h3>Active events</h3>
            @if($activeEvents->count() > 0)
                <div class="panel panel-default" id="protected">
                    @include('partak.events.eventsTable', ['Events' => $activeEvents])
                </div>
            @endif
        </div>
        <div class="container">
            <a data-toggle="collapse" href="#collapseT2"><h3>InteGREAT's events</h3></a>
            @if($integreatEvents->count() > 0)
                <div class="panel panel-collapse collapse" id="collapseT2">
                    @include('partak.events.eventsTable', ['Events' => $integreatEvents])
                </div>
            @endif
        </div>
        <div class="container">
            <a data-toggle="collapse" href="#collapseT3"><h3>Languages events</h3></a>
            @if($languagesEvents->count() > 0)
                <div class="panel panel-collapse collapse" id="collapseT3">
                    @include('partak.events.eventsTable', ['Events' => $languagesEvents])
                </div>
            @endif
        </div>
        <div class="container">
            <a data-toggle="collapse" href="#collapseT1"><h3>Old events</h3></a>
            @if($oldEvents->count() > 0)
                <div class="panel panel-collapse collapse" id="collapseT1">
                    @include('partak.events.eventsTable', ['Events' => $oldEvents])
                </div>
            @endif
        </div>
    </div>
    @stop
