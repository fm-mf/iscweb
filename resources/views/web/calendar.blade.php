@extends('web.layouts.subpage')
@section('wrapper-class', 'calendar-wrapper')
@section('navClass', 'navbar-dark')
@section('title', 'Calendar')

@section('content')
    @if(isset($events) && $events->count() > 0)
        <span class="vspace"></span>
        <div class="container events">
            <div class="container container-ow container-sm-height">
                @foreach($events as $event)
                    <span class="vspace"></span>
                    <div class="row row-ow row-sm-height">
                        <div class="col-sm-6 ow-day ow-3 col-sm-height" style="background-image:url({{ url($event->cover()) }})">
                            <span class="day">{!! $event->calendarDateTimeFrom() !!}</span>
                            <h2>{{ $event->name }}</h2>
                        </div>
                        <div class="col-sm-6 ow-detail col-sm-height col-top">
                            {!! $event->description !!}

                            <p>
                            @if(isset($event->facebook_url) && $event->facebook_url != NULL)
                                ► <a href="{{ $event->facebook_url }}"><strong>Facebook event!</strong></a>
                            @endif
                            @if ($event->reservations_enabled)
                                ► <a href="{{ url("/event/{$event->reservations_hash}") }}"><strong>Online reservation!</strong></a>
                            @endif
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
{{--    @else--}}
{{--        <h1>There are no UPCOMING EVENTS. Wait for the next semester ;-)</h1>--}}
    @endif
    <span class="vspace"></span>
    <div class="container events">
        <div class="container container-ow container-sm-height trips-overview">
            <img src="{{ asset('img/web/events/trips-fall-2019.jpg') }}" alt="List of trips organised during the Fall 2019 semester" />
        </div>
    </div>

    <h2>
        <img src="{{ asset('img/web/fb_blue.png') }}">
        <a href="https://www.facebook.com/isc.ctu.prague/events/" target="_blank" rel="noopener"> Subscribe form more information.</a>
    </h2>

    <span class="vspace"></span>

@endsection
