<table class="table">
    <tr>
        <th>Name</th>
        <th>From</th>
        <th>Visible from</th>
        <th>Detail</th>
    </tr>
    @foreach($Events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
            <td>{{ $event->visible_from->toFormattedDateString() }}</td>
            <td><a href="{{ url('partak/events/edit/' . $event->id_event) }}" role="button" class="btn btn-info btn-xs">Detail</a></td>
            @can('acl', 'events.remove') <td><protectedbutton  url="{{ url('partak/events/delete/'. $event->id_event) }}"
                                                               protection-text="Delete event &quot;{{ $event->name }}&quot;?"
                                                               button-style="btn-danger btn-xs"><span class="glyphicon glyphicon-remove up"></span> Delete</protectedbutton></td>
            @endcan
        </tr>
    @endforeach
</table>
