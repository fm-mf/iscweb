<table class="table p-table">
    <tr>
        <th>Name</th>
        <th>From</th>
        <th>Visible from</th>
        <th></th>
    </tr>
    @foreach($Events as $event)
        <tr>
            <td><a href="{{ url('partak/events/edit/' . $event->id_event) }}">{{ $event->name }}</a></td>
            <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
            <td>{{ $event->visible_from->toFormattedDateString() }}</td>
            <td>
                @can('acl', 'events.remove')
                <protectedbutton
                    url="{{ url('partak/events/delete/'. $event->id_event) }}"
                    protection-text="Delete event &quot;{{ $event->name }}&quot;?"
                    button-style="btn-danger btn-xs"
                >
                    <i class="fas fas-times"></i> Delete
                </protectedbutton>
                @endcan
            </td>
        </tr>
    @endforeach
</table>
