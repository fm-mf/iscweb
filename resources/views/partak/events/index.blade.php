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
                @include('partak.events.eventsTable', ['events' => $activeEvents])
            @endif
        </div>
        <div class="container">
            <h4>InteGREAT's events</h4>
            @if($integreatEvents->count() > 0)
                @include('partak.events.eventsTable', ['events' => $integreatEvents])
            @endif
        </div>
        <div class="container">
            <h4>Languages events</h4>
            @if($languagesEvents->count() > 0)
                @include('partak.events.eventsTable', ['events' => $languagesEvents])
            @endif
        </div>
        <div class="container">
            <a data-toggle="collapse" href="#collapseT1"><h3>Old events</h3></a>
            @if($oldEvents->count() > 0)
                <div class="panel panel-collapse collapse" id="collapseT1">
                    @include('partak.events.eventsTable', ['events' => $oldEvents])
                </div>
            @endif
        </div>
    </div>
    @stop
