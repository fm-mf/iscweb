@extends('partak.events.layout')
@section('inner-content')

    <div class="row-grey">
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-12">
                    <h3>Active events</h3>
                    @if($activeEvents->count() > 0)
                        <div class="panel panel-default" id="protected">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>From</th>
                                    <th>Visible from</th>
                                    <th>Detail</th>
                                </tr>
                                @foreach($activeEvents as $event)
                                    <tr>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
                                        <td>{{ $event->visible_from->toFormattedDateString() }}</td>
                                        <td><a href="{{ url('partak/events/edit/' . $event->id_event) }}" role="button" class="btn btn-info btn-xs">Detail</a></td>
                                        @can('acl', 'events.remove') <td><protectedbutton  url="{{ url('partak/events/delete/'. $event->id_event) }}"
                                                              protection-text="Delete {{ $event->name }} trip?"
                                                              button-style="btn-danger"><span class="glyphicon glyphicon-remove up"></span> Delete</protectedbutton></td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row row-inner">
                <div class="col-sm-12">
                    <ul class="list-unstyled">
                        <li id="t1"><a data-toggle="collapse" data-parent="t1" href="#collapseT1"><h3>Old events</h3></a>
                            @if($oldEvents->count() > 0)
                                <div class="panel panel-collapse collapse" id="collapseT1">
                                    <table class="table">
                                        <tr>
                                            <th>Name</th>
                                            <th>From</th>
                                            <th>Visible from</th>
                                            <th>Detail</th>
                                        </tr>
                                        @foreach($oldEvents as $event)
                                            <tr>
                                                <td>{{ $event->name }}</td>
                                                <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
                                                <td>{{ $event->visible_from->toFormattedDateString() }}</td>
                                                <td><a href="{{ url('partak/events/edit/' . $event->id_event) }}" role="button" class="btn btn-info btn-xs">Detail</a></td>
                                                @can('acl', 'events.remove') <td><protectedbutton  url="{{ url('partak/events/delete/'. $event->id_event) }}"
                                                                                                   protection-text="Delete {{ $event->name }} trip?"
                                                                                                   button-style="btn-danger"><span class="glyphicon glyphicon-remove up"></span> Delete</protectedbutton></td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @stop