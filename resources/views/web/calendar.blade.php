@extends('web.layouts.layout')
@section('title', 'Calendar')

@section('header')
    <div class="header-wrapper calendar">
        <header>
            @include('web.layouts.navigation')
            <h1>Calendar</h1>
        </header>
    </div>
@endsection

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    @if(isset($events) && $events->count() > 0)
                        <ul class="list-unstyled events">
                            @foreach($events as $event)
                                @include('partials.calendar-event')
                            @endforeach
                        </ul>
                    @else
                        <p>
                            There are no upcoming events. Wait for the next semester ;-)
                        </p>
                    @endif
                    <p>
                        <a href="https://www.facebook.com/esn.ctu.prague/events" target="_blank" rel="noopener">
                            <span class="fab fa-facebook-square fa-lg"></span>
                            Subscribe for more information
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
