@extends('web.layouts.layout')

@section('title', "$event->name – Events")
@section('description', Str::limit(strip_tags($event->description), 160, "…"))
@section('og-image')
  @if($event->hasCover())
    <meta property="og:image" content="{{ $event->coverUrl }}" />
    <meta property="og:image:width" content="{{ getimagesize(public_path($event->coverPath))[0] }}" />
    <meta property="og:image:height" content="{{ getimagesize(public_path($event->coverPath))[1] }}" />
  @endif
@endsection

@section('stylesheets')
  @parent
  <link rel="stylesheet" type="text/css" href="{{ mix('css/form.css') }}" />
@endsection

@section('page')
  <div id="form-app">
    <div class="header">
      @isset($event->cover)
        <img src="{{ $event->coverUrl }}" alt="{{ $event->name }}" />
      @endisset
      <h1>{{ $event->name }}</h1>
    </div>

    <div class="info">
      <div class="line when">
        <i class="fas fa-clock fa-fw" title="When?"></i>
        <span>{!! $event->trip ? $event->trip->eventDateInterval() : $event->eventsDateTimeFrom() !!}</span>
      </div>
      @if ($event->location)
      <div class="line where">
        <i class="fas fa-thumbtack fa-fw" title="Location"></i><span>
        @if ($event->location_url)
          <a href="{{ $event->location_url }}" target="_blank">{{ $event->location }}</a></span>
        @else
          {{ $event->location }}
        @endif
      </div>
      @endif
      <div class="line price">
        <i class="fas fa-money-bill-wave-alt fa-fw" title="Price"></i>
        <span>@if ($event->trip && $event->trip->price) {{ $event->trip->price }} CZK @else FREE @endif</span>
      </div>
      @if ($event->facebook_url)
      <div class="line facebook" title="Facebook event link">
        <i class="fab fa-facebook fa-fw"></i>
        <span><a href="{{ $event->facebook_url }}">Facebook event</a></span>
      </div>
      @endif
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
        @elseif ($canReserve !== false)
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
        :payment-on-spot="!!{{ $event->reservations_payment_on_spot }}"
        type="{{ $event->trip ? $event->trip->type : 'event' }}"
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

  @include ('footer')
@stop

@section('scripts')
  @parent
  <script src="{{ mix('js/reservation.js') }}" defer="defer"></script>
@endsection
