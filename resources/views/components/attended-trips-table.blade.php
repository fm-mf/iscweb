<div class="table-responsive">
    <table class="table p-table">
        <thead>
            <tr>
                <th>Trip name</th>
                <th>From</th>
                <th>To</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trips as $trip)
                @component('components.attended-trips-table-row', compact('trip'))
                @endcomponent
            @endforeach
        </tbody>
    </table>
</div>
