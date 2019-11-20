@extends('layouts.reservation.layout')

@section('content')
  <div id="form-app">
    <div class="header">
      <img src="{{ url($event->cover()) }}" alt="{{ $event->name }}" />
      <h1>{{ $event->name }}</h1>
    </div>

    <div class="info">
      <div class="line when"><i class="fas fa-clock fa-fw"></i><span>{!! $event->trip->eventDateInterval() !!}</span></div>
      <div class="line where"><i class="fas fa-thumbtack fa-fw"></i><span><a href="{{ $event->location_url }}" target="_blank">{{ $event->location }}</a></span></div>
      <div class="line price"><i class="fas fa-money-bill-wave-alt fa-fw"></i><span>@if ($event->price) {{ $event->price }} CZK @else FREE @endif</span></div>
      <div class="description" v-if="!showRegistration">
        {!! $event->description !!}

        <button class="register" v-on:click="toggleRegistration(true)"><i class="fas fa-arrow-right"></i> Reserve</button>
      </div>
    </div>

    <div class="registration" v-if="showRegistration">
      <reservation
        event-hash="{{ $event->reservations_hash }}"  
        :show-medical-issues="!!{{ $event->reservations_medical ?: '0' }}"
        :show-diet="!!{{ $event->reservations_diet ?: '0' }}"
        v-on:cancel="toggleRegistration(false)"
      ></reservation>
    </div>
  </div>
@stop