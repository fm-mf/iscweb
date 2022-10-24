@extends('partak.trips.layout')
@section('inner-content')
    @if(session('tripDeleted'))
        <div class="success">
            <i class="fas fa-check mr-1"></i> {{ session('tripDeleted') }}
        </div>
    @endif

    <div class="container">
        <div class="d-flex">
            <h3>Upcoming trips</h3>
            @can('acl', 'trips.add')
            <div class="ml-4">
                <a
                    href="{{ route('partak.trips.create') }}"
                    role="button"
                    class="btn btn-success btn-sm"
                >
                    <i class="fas fa-plus"></i>
                    Add trip
                </a>
            </div>
            @endcan
        </div>

        @if($visibleTrips->count() > 0)
            @include('partak.components.trips-table', ['trips' => $visibleTrips, 'detail' => false])

            {!! $visibleTrips->render() !!}
        @else
            @include('partak.components.no-data')
        @endif
    </div>
@stop
