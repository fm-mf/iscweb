@extends('layouts.form.layout')

@section('content')
  <div id="form-app">
    <div class="header">
      <img src="{{ url($event->cover()) }}" alt="{{ $event->name }}" />
      <h1>{{ $event->name }}</h1>
    </div>

    <div class="info">
      <div class="line when"><i class="fas fa-clock fa-fw"></i><span>{!! $event->eventsDateTimeFrom() !!}</span></div>
      <div class="line where"><i class="fas fa-thumbtack fa-fw"></i><span><a href="{{ $event->location_url }}" target="_blank">{{ $event->location }}</a></span></div>
      <div class="line price"><i class="fas fa-money-bill-wave-alt fa-fw"></i><span>@if ($event->price) {{ $event->price }} CZK @else FREE @endif</span></div>
      <div class="description" v-if="!showRegistration">
        {!! $event->description !!}

        <button v-on:click="toggleRegistration(true)"><i class="fas fa-arrow-right"></i> Register</button>
      </div>
    </div>

    <div class="registration" v-if="showRegistration">
      <div class="title">Registration</div>

      <preregistration event-hash="{{ $event->preregistration_hash }}" v-on:cancel="toggleRegistration(false)"></preregistration>
    </div>
  </div>
@stop