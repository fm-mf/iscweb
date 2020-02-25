<div class="table-responsible">
    <table class="table p-table" id="protected">
        <thead>
            <tr>
                <th>Name</th>
                <th>From</th>
                <th>To</th>
                <th>Price</th>
                <th>Capacity</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($Trips as $trip)
            <tr>
                <td><a href="{{ url('partak/trips/detail/' . $trip->id_trip) }}">{{ $trip->event->name }}</a></td>
                <td>{{ $trip->event->datetime_from->toFormattedDateString() }}</td>
                <td>{{ $trip->trip_date_to->toFormattedDateString() }}</td>
                <td>{{ $trip->price }}@if(isset($trip->price)) Kč@endif</td>
                <td>{{ $trip->howIsFillSimple() }}</td>
                <td class="text-right">
                    @can('edit', $trip)
                        <a
                            href="{{ url('partak/trips/edit/' . $trip->id_trip) }}"
                            role="button"
                            class="btn btn-success btn-xs btn-sm"
                        >
                            <i class="fas fa-pen"></i> Edit
                        </a>
                    @endcan
                    @can('acl', 'trips.remove')
                        <protectedbutton
                            url="{{ url('partak/trips/delete/'. $trip->id_trip) }}"
                            protection-text="Delete trip &quot;{{ $trip->event->name }}&quot;?"
                            button-style="btn-danger btn-sm"
                        >
                            <i class="fas fa-times"></i> Delete
                        </protectedbutton>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>