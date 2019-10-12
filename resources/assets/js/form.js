/* global EVENT_HASH:readonly */

import Vue from 'vue';
import { getExchangeStudent, getBuddy, saveResponse } from './api';

const STEPS = { INFO: 0, AUTH: 1, QUESTIONS: 2, DONE: 3 };

new Vue({
  el: '#form-app',
  data: () => ({
    STEPS,

    step: STEPS.INFO,
    tab: 'exchange',
    esn: '1437664GEEJ0',
    esnEmail: 'martinezsanchezjaime@gmail.com',
    buddyEmail: 'testuser@test.cz',
    password: 'testuser',
    foodPreference: null,
    medicalIssues: null,
    notes: null,
    userData: null,
    authError: null
  }),
  methods: {
    handleExchangeAuth() {
      getExchangeStudent(this.esnEmail, this.esn)
        .then(data => {
          this.step++;
          return data;
        })
        .then(this.loadUser, this.handleAuthError);
    },

    handleBuddyAuth() {
      getBuddy(this.buddyEmail, this.password)
        .then(data => {
          this.password = null;
          this.step++;
          return data;
        })
        .then(this.loadUser, this.handleAuthError);
    },

    handleAuthError(e) {
      console.error('Auth error', e.response);
      if (e.response && e.response.data) {
        this.authError =
          (e.response.data.errors &&
            e.response.data.errors.email &&
            e.response.data.errors.email[0]) ||
          e.response.data.message;
      }
    },

    loadUser(user) {
      this.authError = null;
      this.userData = user.person;
      this.medicalIssues = this.userData.medical_issues;
      this.foodPreference = this.userData.diet;
    },

    handleFinish() {
      saveResponse(
        EVENT_HASH,
        this.userData.id_user,
        this.foodPreference,
        this.medicalIssues,
        this.notes
      ).then(() => {
        this.step += 1;
        this.userData = null;
      });
    }
  }
});
