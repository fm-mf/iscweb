@extends('partak.trips.layout')
@section('inner-content')
    <div class="container">
        <div class="d-flex">
            <h3>Trips</h3>
            @can('acl', 'trips.add')
                <div class="ml-4">
                    <a href="{{ route('partak.trips.create') }}" role="button" class="btn btn-success btn-sm">
                        <i class="fas fa-plus"></i>
                        Add trip
                    </a>
                </div>
            @endcan
        </div>

        @if ($trips->count() > 0)
            @include('partak.components.trips-table', [
                'trips' => $trips,
                'detail' => true,
            ])
        @else
            @include('partak.components.no-data')
        @endif

        {{ $trips->links() }}
    </div>
@stop
