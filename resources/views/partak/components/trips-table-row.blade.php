<div class="div-tr">
    <div class="div-cell name"><a href="{{ route('partak.trips.detail', $trip->id_trip) }}">{{ $trip->event->name }}</a></div>
    @if (isset($detail) && $detail)
        <div class="div-cell semester">{{ $trip->event->semester ? $trip->event->semester->name : '' }}</div>
    @endif
    <div class="div-cell from">{{ $trip->event->datetime_from->format('j M Y') }}</div>
    <div class="div-cell to">{{ $trip->trip_date_to->format('j M Y') }}</div>
    <div class="div-cell price">{{ $trip->price }}@if (isset($trip->price))
            Kč
        @endif
    </div>
    <div class="div-cell capacity">{{ $trip->howIsFillSimple() }}</div>
    <div class="div-cell actions" class="text-right">
        @can('edit', $trip)
            <a href="{{ route('partak.trips.edit', $trip->id_trip) }}" role="button" class="btn btn-success btn-sm">
                <i class="fas fa-pen"></i> Edit
            </a>
        @endcan
        @can('acl', 'trips.add')
            {{ Form::open(['route' => ['partak.trips.duplicate', $trip], 'method' => 'POST', 'class' => 'd-inline-block']) }}
            <protected-submit-button
                protection-title="Duplicate trip?"
                protection-text="Do you really want to duplicate &quot;{{ $trip->event->name }}&quot; trip?"
                proceed-text="Duplicate"
                classes="btn-info btn-sm"
                proceed-classes="btn-info"
                modal-id="duplicate-event-{{ $trip->id_trip }}"
                :form-group="false"
            >
                <span class="fas fa-copy"></span> Duplicate
            </protected-submit-button>
            {{ Form::close() }}
        @endcan
        @can('acl', 'trips.remove')
            <protectedbutton url="{{ route('partak.trips.delete', $trip->id_trip) }}"
                protection-text="Delete trip &quot;{{ $trip->event->name }}&quot;?" button-style="btn-danger btn-sm">
                <i class="fas fa-times"></i> Delete
            </protectedbutton>
        @endcan
    </div>
</div>
