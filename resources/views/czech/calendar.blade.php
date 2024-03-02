@extends('czech.layouts.layout')
@section('title', 'Kalendář akcí')
@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Kalendář nadcházejících akcí</h1>
                    @if(isset($events) && $events->count() > 0)
                        <ul class="list-unstyled events">
                            @foreach($events as $event)
                                @include('partials.calendar-event')
                            @endforeach
                        </ul>
                    @else
                        <p>
                            Momentálně nejsou naplánovány žádné akce.
                        </p>
                    @endif
                    <p>
                        <a href="https://www.facebook.com/esn.ctu.prague/events" target="_blank" rel="noopener">
                            <span class="fab fa-facebook-square fa-lg"></span>
                            Pro více informací sleduj také události na naší FB stránce
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
