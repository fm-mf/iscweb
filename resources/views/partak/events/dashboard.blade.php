@extends('partak.events.layout')
@section('inner-content')

    @if(session('eventDeleted'))
    <div class="row">
        <div class="row-inner">
            <div class="success">
                <span class="glyphicon glyphicon-ok" style="padding-right:5px;"></span> {{ session('eventDeleted') }}
            </div>
        </div>
    </div>
    @endif

    <div class="row-grey">
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-12">
                    <h3>Active events</h3>
                    @if($activeEvents->count() > 0)
                        <div class="panel panel-default" id="protected">
                            @include('partak.events.evetsTable', ['Events' => $activeEvents])
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row-inner">
                <div class="col-sm-12">

                    <a data-toggle="collapse" data-parent="t2" href="#collapseT2"><h3>InteGREAT's events</h3></a>
                            @if($integreatEvents->count() > 0)
                                <div class="panel panel-collapse collapse" id="collapseT2">
                                    @include('partak.events.evetsTable', ['Events' => $integreatEvents])
                                </div>
                            @endif


                </div>
            </div>
        </div>
        <div class="container">
            <div class="row-inner">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li id="t1"><a data-toggle="collapse" data-parent="t3" href="#collapseT3"><h3>Languages events</h3></a>
                            @if($languagesEvents->count() > 0)
                                <div class="panel panel-collapse collapse" id="collapseT3">
                                    @include('partak.events.evetsTable', ['Events' => $languagesEvents])
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row-inner">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li id="t1"><a data-toggle="collapse" data-parent="t1" href="#collapseT1"><h3>Old events</h3></a>
                            @if($oldEvents->count() > 0)
                                <div class="panel panel-collapse collapse" id="collapseT1">
                                    @include('partak.events.evetsTable', ['Events' => $oldEvents])
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @stop
