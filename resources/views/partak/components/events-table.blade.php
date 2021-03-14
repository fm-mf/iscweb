@if($events->isEmpty())
    <p class="alert alert-light">
        {{ $slot }}
    </p>
@else
    <div class="table-responsive">
        <table class="table p-table">
            <thead>
            <tr>
                <th>Name</th>
                <th>From</th>
                <th>Visible from</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                @component('partak.components.events-table-row', compact('event'))
                @endcomponent
            @endforeach
            </tbody>
        </table>
    </div>
@endif
