<div class="list-table trips-list break-lg" id="protected">
    <div class="div-tr div-header">
        <div class="div-cell name">Name</div>
        @if (isset($detail) && $detail)
            <div class="div-cell semester">Semester</div>
        @endif
        <div class="div-cell to">From</div>
        <div class="div-cell from">To</div>
        <div class="div-cell price">Price</div>
        <div class="div-cell capacity">Capacity</div>
        <div class="div-cell actions">Actions</div>
    </div>
    <div class="div-body">
        @php
            $detail = isset($detail) ? $detail : false;
        @endphp
        @foreach ($trips as $trip)
            @component('partak.components.trips-table-row', compact('trip', 'detail'))
            @endcomponent
        @endforeach
    </div>
</div>
