<table class="table p-table">
    <tr>
        <th>Name</th>
        <th>From</th>
        <th>Visible from</th>
        <th></th>
    </tr>
    @foreach($Events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
            <td>{{ $event->visible_from->toFormattedDateString() }}</td>
            <td class="text-right">
                @can('acl', 'events.edit')
                <a href="{{ url('partak/events/edit/' . $event->id_event) }}" class="btn btn-success btn-sm">
                    <i class="fas fa-pen"></i> Edit
                </a>
                @endcan
                @can('acl', 'events.remove')
                <protectedbutton
                    url="{{ url('partak/events/delete/'. $event->id_event) }}"
                    protection-text="Delete event &quot;{{ $event->name }}&quot;?"
                    button-style="btn-danger btn-sm"
                >
                    <i class="fas fa-times"></i> Delete
                </protectedbutton>
                @endcan
            </td>
        </tr>
    @endforeach
</table>
