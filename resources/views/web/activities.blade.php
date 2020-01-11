@extends('web.layouts.layout')
@section('title', 'Activities')

@section('page')
    <section class="activities-header">
    </section>
    @include('web.partials.activities-menu')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-auto mx-auto">
                    <blockquote class="motivation-quote-big">
                        <p>
                            Dream. Explore. Learn. Share. Discover.
                        </p>
                    </blockquote>
                </div>
            </div>
            @isset($contact)
                <div class="row contacts">
                    <div class="col-auto mx-auto">
                        @include('partials.contact', compact('contact'))
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
