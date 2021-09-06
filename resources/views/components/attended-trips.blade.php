<div class="container">
    <h4>{{ $title ?? 'Attended trips' }}</h4>

    @if ($trips->isEmpty())
        <p class="text-muted">
            {{ $emptyMessage ?? "$studentName has not attended any trips yet." }}
        </p>
    @else
        @component('components.attended-trips-table', compact('trips'))
        @endcomponent
    @endif
</div>
