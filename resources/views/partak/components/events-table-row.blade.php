<tr>
    <td>
        <a href="{{ route('event.show', $event->reservations_hash) }}">
            {{ $event->name }}
        </a>
    </td>
    <td>{{ $event->datetime_from->toFormattedDateString() }}</td>
    <td>{{ $event->visible_from->toFormattedDateString() }}</td>
    <td>
        <div class="d-flex justify-content-end">
            @can('acl', 'events.edit')
                <a href="{{ route('partak.events.edit', $event) }}" class="btn btn-success btn-sm">
                    <span class="fas fa-pen"></span> Edit
                </a>
            @endcan
            @can('acl', 'events.add')
                {{ Form::open(['route' => ['partak.events.duplicate', $event], 'method' => 'POST', 'class' => 'd-inline-block ml-1']) }}
                    <protected-submit-button
                        protection-title="Duplicate event?"
                        protection-text="Do you really want to duplicate &quot;{{ $event->name }}&quot; event?"
                        proceed-text="Duplicate"
                        classes="btn-info btn-sm"
                        proceed-classes="btn-info"
                        modal-id="duplicate-event-{{ $event->id_event }}"
                        :form-group="false"
                    >
                        <span class="fas fa-copy"></span> Duplicate
                    </protected-submit-button>
                {{ Form::close() }}
            @endcan
            @can('acl', 'events.remove')
                {{ Form::open(['route' => ['partak.events.destroy', $event], 'method' => 'DELETE', 'class' => 'd-inline-block ml-1']) }}
                <protected-submit-button
                    protection-title="Delete event?"
                    protection-text="Do you really want to delete &quot;{{ $event->name }}&quot; event? The deletion irreversible!"
                    proceed-text="Delete"
                    classes="btn-danger btn-sm"
                    proceed-classes="btn-danger"
                    modal-id="delete-event-{{ $event->id_event }}"
                    :form-group="false"
                >
                    <span class="fas fa-trash"></span> Delete
                </protected-submit-button>
                {{ Form::close() }}
            @endcan
        </div>
    </td>
</tr>
