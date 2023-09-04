@extends('layouts.buddyprogram.layout')

@section('content')
    <div class="container page">
        <h2 class="text-center">
            @lang('buddy-program.closed-title', [
                'semester' => $semester->name_localized_long,
                'buddyDbFromDate' => $buddyDbFrom->formatLocalized(__('formatting.full-date')),
                'buddyDbFromTime' => $buddyDbFrom->formatLocalized(__('formatting.time-h-m')),
                'at' => trans_choice('buddy-program.at-time', $buddyDbFrom->hour)
            ])
        </h2>
        <p class="text-center">
            @lang('buddy-program.closed-follow-fb-group')
            <a href="{{ $fbGroupCzechBuddies }}" target="_blank" rel="noopener">ISC CTU Czech Buddies</a>
            @lang('buddy-program.closed-follow-fb-page')
            <a href="{{ $fbPageUrl }}" target="_blank" rel="noopener">ISC CTU in Prague</a>.
        </p>
        <p class="text-center">
            @lang('buddy-program.closed-join-discord-text')
        </p>
        <p class="text-center">
            <a href="{{ $buddyDiscordLink }}" target="_blank" rel="noopener" class="btn btn-primary">
                @lang('buddy-program.closed-join-discord-btn')
            </a>
        </p>
        <picture class="closed-map">
            <source type="image/webp" srcset="{{ asset(asset('img/buddyprogram/buddy_database_map.webp')) }}" />
            <img src="{{ asset('img/buddyprogram/buddy_database_map.jpg') }}" alt="@lang('buddy-program.world-map-alt')" />
            <span class="map-text">
                @lang('buddy-program.closed-map-text', [
                    'studentsCnt' => $incomingStudentsCnt,
                    'countriesCnt' => $countriesCnt,
                    'students' => trans_choice('buddy-program.students', $incomingStudentsCnt),
                    'countries' => trans_choice('buddy-program.countries', $countriesCnt),
                    'from' => trans_choice('buddy-program.from', $countriesCnt),
                    'are' => trans_choice('buddy-program.are', $incomingStudentsCnt),
                ])
            </span>
        </picture>
    </div>
@stop
