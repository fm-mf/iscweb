@extends('web.layouts.layout')
@section('title', 'Sports – Activities')

@section('page')
    <section class="activities-header">
    </section>
    @include('web.partials.activities-menu')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-auto mx-auto">
                    <blockquote class="motivation-quote">
                        <p>Just play. Have fun. Enjoy the game.</p>
                        <p>Michael Jordan</p>
                    </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col-10 mx-auto">
                    <p>Do you like playing football, volleyball, floorball or even practicing yoga?
                        If you want to practice such sports even in Prague, you can do so every week
                        mostly at Juliska sport center &ndash; all you need is to check the current
                        situation (activities/sports on this website), come, and play.</p>
                    <p>There are several sports organized throughout the semester for international
                        and Czech students. The level of sport events depends a lot on your
                        participation and propositions.</p>
                    <p>To enroll to any sport, follow partial instructions or just contact
                        the supervising person (instructor).
                        Some of the sports are for free, some are paid.</p>
                    @isset($contact)
                    <p>You can as well contact the Sports coordinator, <strong>{{ $contact['name'] }}</strong>
                        (<a href="mailto:{{ $contact['email']}}">{{ $contact['email'] }}</a>).
                        If you don't receive an answer, just write once again, please.</p>
                    @endisset
                    <p>If you are missing a sport in the list of available sports,
                        please contact the sport coordinator.</p>
                    <p>In order to assess the interest in a sport,
                        please join the group of the chosen sport on Facebook.</p>

                    <p><strong>All sports are starting during the 1st and 2nd week of the semester.</strong></p>
                </div>
            </div>
            @isset($sports)
                {{-- TODO finish sports formating --}}
                <h2>Schedule for {{ $currentSemester }}</h2>
                <ul class="row list-unstyled sports-list">
                    @foreach($sports as $sport)
                        <li class="col-md-5 col-sm-6">
                            <h3>{{ $sport->name }}</h3>
                            <dl>
                                <dt>When</dt>
                                <dd>{{ $sport->when }}</dd>
                                <dt>Starting day</dt>
                                <dd>{{ $sport->from }}</dd>
                                <dt>Where</dt>
                                <dd>{{ $sport->where }}</dd>
                                <dt>Meeting point</dt>
                                <dd>{{ $sport->meetingPoint }}</dd>
                                <dt>Price</dt>
                                <dd>{{ $sport->price }}</dd>
                                <dt>Contact person</dt>
                                <dd>{{ $sport->contactPerson }}</dd>
                                <dt>What to bring</dt>
                                <dd>{{ $sport->requiredEquipment }}</dd>
                                <dt>Facebook</dt>
                                <dd>{{ $sport->facebook }}</dd>
                            </dl>
                        </li>
                    @endforeach
                </ul>
            @else
                <h2>Schedule for {{ $currentSemester }} coming soon…</h2>
            @endif
        </div>
    </section>
    <section>
        <div class="container">
            @component('web.components.gallery-list', ['images' => [
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-2.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-2-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-3.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-3-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-8.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-8-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-12.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-12-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-13.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-13-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-4.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-4-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-9.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-9-t.jpg',
                ],
                [
                    'fullSizeUrl' => 'img/web/activities/sports/sports-11.jpg',
                    'thumbnailUrl' => 'img/web/activities/sports/sports-11-t.jpg',
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
