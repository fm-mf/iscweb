@extends('web.layouts.layout')
@section('title', 'inteGREAT – Activities')

@section('page')
    <section class="activities-header">
    </section>
    @include('web.partials.activities-menu')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-auto mx-auto">
                    <blockquote class="motivation-quote">
                        <p>
                            Share. Experience. InteGREAT!
                        </p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-10 mx-sm-auto">
                    <h2>Country presentations</h2>
                    <p>
                        Every year there are dozens of nationalities coming to Prague. Imagine the variety of cultures,
                        traditions, local customs or cooking practices to discover. That is why we have the inteGREAT
                        team, to give students the opportunity to get familiar with countries of their fellow exchange
                        students and then present their own country in return. Not only is it interesting but it’s also
                        a great place where to meet new friends, international and Czech as well.
                    </p>

                </div>
            </div>

            @if(isset($events) && $events->count() > 0)
                <div class="row">
                    <div class="col">
                        <h2>Schedule of the {{ $currentSemester }} presentations</h2>
                        <table class="presentations-list">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Theme</th>
                                    <th>Presenting Countries</th>
                                    <th>More info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $integreat)
                                    <tr>
                                        <td>{{ $integreat->event->datetime_from->format('l, j F') }}</td>
                                        <td>{{ $integreat->theme }} </td> <td>{{ $integreat->countries }}</td>
                                        <td><a {{ isset($integreat->event->facebook_url)? 'href='.$integreat->event->facebook_url : ''  }} target="_blank">Facebook event</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @component('web.components.gallery-list', ['images' => [
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-1.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-1-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-2.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-2-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-3.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-3-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-4.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-4-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-5.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-5-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-6.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-6-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-7.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-7-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/presentations/presentations-8.jpg',
                    'thumbnailUrl' => 'img/web/activities/presentations/presentations-8-t.jpg',
                ],
            ]])
            @endcomponent


        </div>
    </section>
    <section>
        <div class="container">
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
