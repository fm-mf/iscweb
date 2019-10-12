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
      <div class="description" v-if="step === STEPS.INFO">
        {!! $event->description !!}

        <button @click="step++"><i class="fas fa-arrow-right"></i> Register</button>
      </div>
    </div>

    <div class="registration" v-if="step > STEPS.INFO">
      <div class="title">Registration</div>

      <div class="auth-step" v-if="!userData && step === STEPS.AUTH">
        <div class="tab-header">
          <div class="tab" :class="[tab, { selected: tab === 'exchange' }]" v-on:click="tab='exchange'">Exchange student</div>
          <div class="tab" :class="[tab, { selected: tab === 'buddy' }]" v-on:click="tab='buddy'">Buddy</div>
          <div class="tab" :class="[tab, { selected: tab === 'other' }]" v-on:click="tab='other'">Other</div>
        </div>

        <div class="tab-body">
          <div class="auth-error">
            <div class="auth-error-body" v-show="!!authError">
              <div class="icon"><i class="fas fa-exclamation-circle"></i></div>
              <span>@{{ authError }}</span>
            </div>
          </div>

          <div class="tab" v-show="tab === 'exchange'">
            <form class="form" @submit.prevent="handleExchangeAuth">
              <div class="form-group">
                <label>E-mail</label>
                <input name="email" type="email" v-model="esnEmail" />
              </div>
              <div class="form-group">
                <label>ESN Card Number</label>
                <input type="text" name="esn" v-model="esn" />
              </div>
              <button>Continue</button>
            </form>
          </div>

          <div class="tab" v-show="tab === 'buddy'">
            <form class="form" @submit.prevent="handleBuddyAuth">
              <div class="form-group">
                <label>E-mail</label>
                <input name="email" type="email" v-model="buddyEmail" />
              </div><div class="form-group">
                <label>Password</label>
                <input name="password" type="password" v-model="password" />
              </div>
              <button>Continue</button>
            </form>
          </div>

          <div class="tab" v-show="tab === 'other'">
            <p>If you don't have an ESN Card and still want to join this event, come to the <a href="/contact" target="blank">ISC Point</a> and register there.</p><p>Beware that trips require you to have ESN Card, which you can also obtain at the <a href="/contact" target="blank">ISC Point</a>.</p>
          </div>
        </div>
      </div>

      <div class="user-data" v-if="userData && step !== STEPS.DONE">
        <i class="fas fa-user-circle"></i>
        <div class="user-name">@{{ userData.first_name }} @{{ userData.last_name }}</div>
        <div class="button change" @click="userData = null; step = STEPS.AUTH"><i class="fas fa-times"></i></div>
      </div>

      <div class="questions-step" v-if="step === STEPS.QUESTIONS">
        <form class="form" @submit.prevent="handleFinish">
          <div class="form-group" v-if="{{ $event->preregistration_diet }}">
            <label>Food preference</label>
            <select v-model="foodPreference">
              <option :value="null">No preference</option>
              <option value="Vegetarian">Vegetarian</option>
              <option value="Vegan">Vegan</option>
              <option value="Fish Only">Fish only</option>
            </select>
          </div>

          <div class="form-group" v-if="{{ $event->preregistration_medical }}">
            <label>Medical issues</label>
            <textarea v-model="medicalIssues"></textarea>
          </div>

          <div class="form-group">
            <label>Notes to organizers</label>
            <textarea v-model="notes"></textarea>
          </div>

          <button><i class="fas fa-check"></i> Confirm registration</button>
        </form>
      </div>

      <div class="done-step" v-if="step >= STEPS.DONE">
        <div class="done-message">
          <div class="icon">
            <i class="fas fa-check"></i>
          </div>
          <span>You have been registered</span>
        </div>

        <p>Thank you for registering. You can now go to <a href="/contact" target="blank">ISC Point</a> and pay the fee to get your spot.</p>

        <p>If you can't make it, please cancel your spot using the link you've received in your e-mail to allow other students to take your spot.</p>

        <button @click="step=STEPS.INFO">Back to info</button>
      </div>
    </div>
  </div>
@stop