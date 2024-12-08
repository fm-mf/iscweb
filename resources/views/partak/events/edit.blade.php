@extends('partak.events.layout')
@section('inner-content')

    @if(session('successUpdate'))
        <div class="success top-message">
            <i class="fas fa-check mr-1"></i>{{ session('successUpdate') }}
        </div>
    @endif


    <div class="container" id="form">
        <div class="col-xl-8">
            <div class="d-flex">
                <h2>Edit event</h2>
                @can('acl', 'trips.add')
                    {{ Form::open(['route' => ['partak.events.to-trip', $event], 'method' => 'post']) }}
                        <protected-submit-button
                            protection-title="Convert this event to a trip?"
                            protection-text="The event <em>{{ $event->name }}</em> will be converted to a trip. This action is irreversible."
                            :protection-text-html="true"
                            proceed-text="Convert to trip"
                            classes="btn btn-outline-secondary btn-sm ml-4"
                            proceed-classes="btn-warning"
                            modal-id="protection-modal-event-to-trip"
                            :form-group="false"
                        >
                            <i class="fas fa-level-up-alt"></i><i class="fas fa-hiking"></i> Convert to trip
                        </protected-submit-button>
                    {{ Form::close() }}
                @endcan
            </div>
            {{ Form::model($event, ['route' => ['partak.events.update', $event], 'method' => 'patch', 'id' => 'form', 'files' => true]) }}

            @include('partak.trips.editForm',['trips' => false])

            {{ Form::bsSubmit('Update event') }}

            {{ Form::close() }}
        </div>
    </div>
@stop
