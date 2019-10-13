<template>
  <div class="loader-container">
    <loader :loaded="loaded" />

    <auth
      v-if="!userData && step === STEPS.AUTH"
      :loaded="loaded"
      @loaded="handleLoaded"
      @auth="handleAuth"
    />

    <user-info
      v-if="userData && step !== STEPS.DONE"
      :user="userData"
      @logout="handleLogout"
    />

    <error :error="error" />

    <questions
      v-if="step === STEPS.QUESTIONS"
      :user="userData"
      :show-medical-issues="showMedicalIssues"
      :show-diet="showDiet"
      @submit="handleFinish"
    />

    <finish v-if="step >= STEPS.DONE" @back="$emit('cancel')" />
  </div>
</template>

<script>
import { saveResponse } from '../api';
import Loader from '../components/Loader';
import Auth from './components/Auth';
import UserInfo from './components/UserInfo';
import Questions from './components/Questions';
import Finish from './components/Finish';
import Error from './components/Error';

const STEPS = { AUTH: 0, QUESTIONS: 1, DONE: 2 };
const flattenErrors = errors =>
  Object.values(errors).reduce((acc, items) => acc.concat(items), []);

export default {
  components: {
    Loader,
    Auth,
    UserInfo,
    Questions,
    Finish,
    Error
  },
  props: {
    eventHash: {
      type: String,
      required: true
    },
    showMedicalIssues: Boolean,
    showDiet: Boolean
  },
  data: () => ({
    STEPS,

    step: STEPS.AUTH,
    loaded: true,
    userData: null,
    error: null
  }),
  methods: {
    handleLoaded(loaded) {
      this.loaded = loaded;
    },

    handleAuth(userData) {
      this.userData = userData;
      this.nextStep();
    },

    handleLogout() {
      this.userData = null;
      this.error = null;
      this.goToStep(STEPS.AUTH);
    },

    handleFinish(data) {
      if (!this.loaded) return;

      this.loaded = false;

      saveResponse(
        this.eventHash,
        this.userData.id_user,
        data.foodPreference,
        data.medicalIssues,
        data.notes
      ).then(
        () => {
          this.userData = null;
          this.nextStep();
        },
        e => {
          this.error =
            (e.response &&
              e.response.data &&
              (e.response.data.errors
                ? flattenErrors(e.response.data.errors)
                : e.response.data.message)) ||
            'Unknown error occured, when trying to save your response. Please contact administrators.';
          this.loaded = true;
        }
      );
    },

    nextStep() {
      this.goToStep(this.step + 1);
    },

    goToStep(step) {
      this.step = step;
      this.error = null;
    }
  }
};
</script>

<style></style>
