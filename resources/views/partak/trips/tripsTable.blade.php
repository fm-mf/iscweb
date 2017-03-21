<table class="table" id="protected">
    <tr>
        <th>Name</th>
        <th>From</th>
        <th>To</th>
        <th>Price</th>
        <th>Capacity</th>
        <th>Actions</th>
    </tr>
    @foreach($Trips as $trip)
        <tr>
            <td>{{ $trip->event->name }}</td>
            <td>{{ $trip->event->datetime_from->toFormattedDateString() }}</td>
            <td>{{ $trip->trip_date_to->toFormattedDateString() }}</td>
            <td>{{ $trip->price }}@if(isset($trip->price)) Kč@endif</td>
            <td>{{ $trip->howIsFillSimple() }}</td>
            <td align="right">
                @can('edit', $trip)
                    <a href="{{ url('partak/trips/edit/' . $trip->id_trip) }}" role="button" class="btn btn-success btn-xs">Edit</a>
                @endcan
                <a href="{{ url('partak/trips/detail/' . $trip->id_trip) }}" role="button" class="btn btn-info btn-xs">Detail</a>
                @can('acl', 'trips.remove')
                    <protectedbutton  url="{{ url('partak/trips/delete/'. $trip->id_trip) }}"
                                      protection-text="Delete {{ $trip->name }} trip?"
                                      button-style="btn-danger btn-xs"><span class="glyphicon glyphicon-remove up"></span> Delete</protectedbutton></td>
                @endcan
        </tr>
    @endforeach
</table>