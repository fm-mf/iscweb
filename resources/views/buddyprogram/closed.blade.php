@extends('layouts.buddyprogram.layout')

@section('content')
    <div class="container page">
        <h2 class="text-center">
            @lang('buddy-program.closed-title', [
                'academicTerm' => $academicTerm,
                'academicYear' => $academicYear,
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
        <div class="col">
            <img src="{{ asset('img/buddyprogram/buddy-database-map-fall2020-' . app()->getLocale() . '.jpg') }}" style="width: 100%" alt="@lang('buddy-program.world-map-alt')" />
        </div>
    </div>
@stop
