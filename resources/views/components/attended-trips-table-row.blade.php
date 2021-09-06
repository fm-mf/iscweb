<tr>
    <td>
        <a href="{{ route('partak.trips.detail', $trip) }}">
            {{ $trip->event->name }}
        </a>
    </td>
    <td>
        {{ $trip->event->datetime_from->formatLocalized(__('formatting.full-date')) }}
    </td>
    <td>
        {{ $trip->trip_date_to->formatLocalized(__('formatting.full-date')) }}
    </td>
</tr>
