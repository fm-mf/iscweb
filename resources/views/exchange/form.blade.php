@extends('layouts.form.layout')

@section('content')
  <div id="form-app">
    <div class="header">
      <img src="files/269.jpeg" alt="ISC Bowling" />
      <h1>ISC Bowling</h1>
    </div>

    <div class="info">
      <div class="line when"><i class="fas fa-clock fa-fw"></i><span>Wednesday 12.9.2019 19:00 - 22:00</span></div>
      <div class="line where"><i class="fas fa-thumbtack fa-fw"></i><span>Bowling Dejvice</span></div>
      <div class="line price"><i class="fas fa-money-bill-wave-alt fa-fw"></i><span>180 CZK</span></div>
      <div class="description">
        <p>Hello everyone !!</p>
        <p>Do you want to play bowling and meet some new friends?? Then this event is for you !! Don't hesitate and come to play bowling with us just for fun and to meet some new people :)</p>
      </div>
    </div>

    <div class="registration">
      <div class="title">Registration</div>

      <div class="auth-step" v-if="step === STEPS.AUTH">
        <div class="tab-header">
          <div class="tab" :class="[tab, { selected: tab === 'exchange' }]" v-on:click="tab='exchange'">Exchange student</div>
          <div class="tab" :class="[tab, { selected: tab === 'buddy' }]" v-on:click="tab='buddy'">Buddy</div>
        </div>

        <div class="tab-body">
          <div class="tab" v-show="tab === 'exchange'">
            <form class="form" @submit.prevent="handleExchangeAuth">
              <div class="form-group">
                <label>E-mail</label>
                <input name="email" type="email" v-model="email" />
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
                <input name="email" type="email" v-model="email" />
              </div><div class="form-group">
                <label>Password</label>
                <input name="password" type="password" v-model="password" />
              </div>
              <button>Continue</button>
            </form>
          </div>
        </div>
      </div>

      <div class="user-data" v-if="userData && step !== STEPS.DONE">
        <i class="fas fa-user-circle"></i>
        <div class="user-name">@{{ userData.first_name }} @{{ userData.last_name }}</div>
        <div class="button change" @click="userData = null; step = STEPS.AUTH"><i class="fas fa-times"></i></div>
      </div>

      <div class="questions-step" v-if="step === STEPS.QUESTIONS">
        <form class="form" @submit.prevent="handleNext">
          <div class="form-group">
            <label>Food preference</label>
            <select v-model="foodPreference">
              <option value="no">No preference</option>
              <option value="vegetarian">Vegetarian</option>
              <option value="vegan">Vegan</option>
              <option value="fish_only">Fish only</option>
            </select>
          </div>

          <div class="form-group" v-show="foodPreference === 'other'">
            <label>Other food preference</label>
            <textarea v-model="foodPreferenceOther"></textarea>
          </div>

          <button>Continue</button>
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
      </div>
    </div>
  </div>
@stop