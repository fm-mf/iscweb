@extends('partak.events.layout')
@section('inner-content')

    <div class="row row-grey">
        <div class="row-inner">
            <div class="col-sm-12">
                <h3>Active trips</h3>
                @if($activeEvents->count() > 0)
                    <div class="panel panel-default" id="protected">
                        <table class="table">
                            <tr>
                                <th>Name</th>
                                <th>Visible from</th>
                                <th>From</th>
                                <th>Detail</th>
                            </tr>
                            @foreach($activeEvents as $event)
                                <tr>
                                    <td>{{ $event->name }}</td>
                                    <td>{{ $event->visible_from->toFormattedDateString() }}</td>
                                    <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
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
    @stop