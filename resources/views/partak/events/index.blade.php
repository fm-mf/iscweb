@extends('partak.events.layout')

@section('inner-content')
    @if(session('eventDeleted'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i> {{ session('eventDeleted') }}
        </div>
    @endif

    <div class="container">
        <h2>Active events</h2>
        @component('partak.components.events-table', ['events' => $activeEvents])
            There are no upcoming events :(
        @endcomponent
    </div>
    <div class="container">
        <h3>InteGREAT events</h3>
        @component('partak.components.events-table', ['events' => $integreatEvents])
            There are no upcoming inteGREAT events :(
        @endcomponent
    </div>
    <div class="container">
        <h3>Languages events</h3>
        @component('partak.components.events-table', ['events' => $languagesEvents])
            There are no upcoming Languages events :(
        @endcomponent
    </div>
    <div class="container">
        <a data-toggle="collapse" href="#collapseT1"><h2>Old events</h2></a>
        <div class="collapse" id="collapseT1">
            @component('partak.components.events-table', ['events' => $oldEvents])
                There are no past events :(
            @endcomponent
        </div>
    </div>
@stop
