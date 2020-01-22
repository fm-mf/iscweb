@extends('layouts.reservation.layout')

@section('content')
  <div id="form-app">
    <div class="header">
      @isset($event->cover)
        <img src="{{ $event->coverUrl }}" alt="{{ $event->name }}" />
      @endisset
      <h1>{{ $event->name }}</h1>
    </div>

    <div class="info">
      <div class="line when"><i class="fas fa-clock fa-fw"></i><span>{!! $event->trip->eventDateInterval() !!}</span></div>
      <div class="line where">
        <i class="fas fa-thumbtack fa-fw"></i><span>
        @if ($event->location_url)
          <a href="{{ $event->location_url }}" target="_blank">{{ $event->location }}</a></span>
        @else
          {{ $event->location }}
        @endif
      </div>
      <div class="line price"><i class="fas fa-money-bill-wave-alt fa-fw"></i><span>@if ($event->trip->price) {{ $event->trip->price }} CZK @else FREE @endif</span></div>
      @if (!$isCancellation)
      <div class="description" v-if="!showRegistration">
        {!! $event->description !!}

        @if ($canReserve === true)
          <button
            class="register"
            v-on:click="toggleRegistration(true)"
          >
            <i class="fas fa-arrow-right"></i> Reserve
          </button>
        @else
          <div class="reservations-ended">
            <i class="fas fa-info-circle"></i>
            {{ $canReserve }}
          </div>
        @endif
      </div>
      @endif
    </div>

    @if (!$isCancellation)
    <div class="registration" v-if="showRegistration">
      <reservation
        event-hash="{{ $event->reservations_hash }}"
        :is-ow="!!{{ $event->ow }}"
        :show-medical-issues="!!{{ $event->reservations_medical ?: '0' }}"
        :show-diet="!!{{ $event->reservations_diet ?: '0' }}"
        v-on:cancel="toggleRegistration(false)"
      ></reservation>
    </div>
    @else
    <div class="cancellation">
      <cancellation
        hash="{{ $cancellationHash }}"
      ></cancellation>
    </div>
    @endif
  </div>
@stop
