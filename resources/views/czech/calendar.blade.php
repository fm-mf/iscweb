@extends('czech.layouts.layout')
@section('title', 'Kalenář akcí')
@section('page')
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

                            @if(isset($event->facebook_url) && $event->facebook_url != NULL)
                                <p>
                                    ► <a href="{{ $event->facebook_url }}"><strong>Facebook event!</strong></a>
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <h1>There are no UPCOMING EVENTS. Wait for the next semester ;-)</h1>
        <h2><IMG src="{{ asset('img/web/fb_blue.png') }}"><a href="https://www.facebook.com/isc.ctu.prague/events"> Subscribe</a></h2>
    @endif
@endsection
