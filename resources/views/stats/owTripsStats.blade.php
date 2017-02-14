@extends('web.layouts.layoutOW')
@section('page')
    <div class="container" style="margin-top:60px;">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-1 col-md-8 col-md-offset-2">
                @if(isset($trips))
                    @foreach($trips as $trip)
                        <div class="row">
                            <h3 class="progress-label">{{ $trip->event->name }}</h3>
                            <div class="progress">
                                <div class="progress-bar massive-font" role="progressbar" aria-valuenow="{{ $trip->howIsFillPercentage() }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $trip->howIsFillPercentage() }}%; min-width: 3em;">
                                    {{ $trip->howIsFill() }}/{{ $trip->capacity }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div style="min-height: 100px"></div>
            </div>
        </div>
    </div>
@stop