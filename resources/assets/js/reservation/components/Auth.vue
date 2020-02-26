<template>
  <tabs class="auth-step" @change="resetError">
    <tab id="exchange" title="Exchange student" selected>
      <error :error="error" />
      <form class="form" @submit.prevent="handleExchangeAuth">
        <div v-if="!isOw" class="form-group">
          <label>E-mail</label>
          <input v-model="esnEmail" name="email" type="email" />
        </div>
        <div class="form-group">
          <label>ESN Card Number</label>
          <input v-model="esn" type="text" name="esn" />
        </div>
        <button><i class="fas fa-arrow-right"></i> Continue</button>
        <cancel @click="$emit('cancel')" />
      </form>
    </tab>
    <tab id="buddy" title="Buddy">
      <error :error="error" />
      <form class="form" @submit.prevent="handleBuddyAuth">
        <div class="form-group">
          <label>E-mail</label>
          <input v-model="buddyEmail" name="email" type="email" />
        </div>
        <div class="form-group">
          <label>Password</label>
          <input v-model="password" name="password" type="password" />
        </div>
        <button><i class="fas fa-arrow-right"></i> Continue</button>
        <cancel @click="$emit('cancel')" />
      </form>
    </tab>
    <tab id="other" title="Other">
      <p>
        If you don't have an ESN Card and still want to join this event, come to
        the <a href="/contact" target="blank">ISC Point</a> and register there.
      </p>
      <p>
        Beware that trips require you to have ESN Card, which you can also
        obtain at the <a href="/contact" target="blank">ISC Point</a>.
      </p>
    </tab>
  </tabs>
</template>

<script>
import { getExchangeStudent, getBuddy } from '../../api';
import Tabs from '../../components/Tabs/Tabs';
import Tab from '../../components/Tabs/Tab';
import Error from './Error';
import Cancel from './Cancel';

export default {
  components: {
    Tabs,
    Tab,
    Error,
    Cancel
  },
  props: {
    loaded: Boolean,
    event: String,
    isOw: Boolean
  },
  data: () => ({
    error: null,

    tab: 'exchange',
    esn: '',
    esnEmail: '',
    buddyEmail: '',
    password: ''
  }),
  methods: {
    handleExchangeAuth() {
      if (!this.loaded) return;

      this.$emit('loaded', false);

      getExchangeStudent(this.event, this.esnEmail, this.esn)
        .then(data => {
          this.step++;
          return data;
        })
        .then(this.loadUser, this.handleAuthError);
    },

    handleBuddyAuth() {
      if (!this.loaded) return;

      this.$emit('loaded', false);

      getBuddy(this.event, this.buddyEmail, this.password).then(
        this.loadUser,
        this.handleAuthError
      );
    },

    handleAuthError(e) {
      this.$emit('loaded', true);

      console.error('Auth error', e.response);

      if (e.response && e.response.data) {
        this.error =
          (e.response.data.errors &&
            e.response.data.errors.email &&
            e.response.data.errors.email[0]) ||
          e.response.data.message;
      }
    },

    loadUser(user) {
      this.$emit('loaded', true);
      this.$emit('auth', user);

      this.password = null;
      this.error = null;
    },

    resetError() {
      this.error = null;
    }
  }
};
</script>

<style></style>
