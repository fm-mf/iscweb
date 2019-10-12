import Vue from 'vue';
import { getExchangeStudent, getBuddy } from './api';

const STEPS = { AUTH: 0, QUESTIONS: 1, DONE: 2 };

new Vue({
  el: '#form-app',
  data: () => ({
    STEPS,

    step: STEPS.AUTH,
    tab: 'exchange',
    esn: '1437664GEEJ',
    email: 'martinezsanchezjaime@gmail.com',
    password: null,
    foodPreference: null,
    foodPreferenceOther: null,
    userData: null
  }),
  methods: {
    handleExchangeAuth() {
      getExchangeStudent(this.email, this.esn).then(data => {
        this.userData = data.person;
        this.step++;
      });
    },

    handleBuddyAuth() {
      getBuddy(this.email, this.password).then(data => {
        this.password = null;
        this.userData = data.person;
        this.step++;
      });
    },

    handleNext() {
      this.step += 1;
    }
  }
});
