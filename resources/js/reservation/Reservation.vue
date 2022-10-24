<template>
    <div>
        <div class="title">Registration</div>
        <div class="loader-container">
            <loader :loaded="loaded" />

            <auth
                v-if="!userData && step === STEPS.AUTH"
                :loaded="loaded"
                :event="eventHash"
                :is-ow="isOw"
                :type="type"
                @loaded="handleLoaded"
                @auth="handleAuth"
                @cancel="$emit('cancel')"
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
                :questions="questions"
                @submit="handleFinish"
                @cancel="handleLogout"
            />

            <finish
                v-if="step >= STEPS.DONE"
                :is-ow="isOw"
                :payment-on-spot="paymentOnSpot"
                @back="$emit('cancel')"
            />
        </div>
    </div>
</template>

<script>
/* global EVENT_QUESTIONS:readonly */

import {
    cancelReservation,
    confirmReservation,
    createReservation
} from '../api';
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
        type: String,
        isOw: Boolean,
        showMedicalIssues: Boolean,
        showDiet: Boolean,
        paymentOnSpot: Boolean
    },
    data: () => ({
        STEPS,

        step: STEPS.AUTH,
        loaded: true,
        userData: null,
        error: null,
        questions: EVENT_QUESTIONS,
        reservation: null
    }),
    methods: {
        handleLoaded(loaded) {
            this.loaded = loaded;
        },

        handleAuth(userData) {
            this.userData = userData;
            this.loaded = false;

            createReservation(this.eventHash, this.userData.id_user).then(
                reservation => {
                    this.loaded = true;
                    this.reservation = reservation;
                    this.nextStep();
                },
                e => {
                    this.loaded = true;

                    this.error =
                        (e.response &&
                            e.response.data &&
                            (e.response.data.errors
                                ? flattenErrors(e.response.data.errors)
                                : e.response.data.message)) ||
                        'Unknown error occured, when trying to save your response. Please contact administrators.';
                }
            );
        },

        handleLogout() {
            if (this.reservation) {
                cancelReservation(this.reservation.hash);
            }

            this.userData = null;
            this.error = null;
            this.goToStep(STEPS.AUTH);
        },

        handleFinish(data) {
            if (!this.loaded) return;

            this.loaded = false;

            confirmReservation(
                this.eventHash,
                this.userData.id_user,
                data.foodPreference,
                data.medicalIssues,
                data.notes,
                data.custom
            ).then(
                () => {
                    this.loaded = true;
                    this.userData = null;
                    this.nextStep();
                },
                e => {
                    this.loaded = true;

                    this.error =
                        (e.response &&
                            e.response.data &&
                            (e.response.data.errors
                                ? flattenErrors(e.response.data.errors)
                                : e.response.data.message)) ||
                        'Unknown error occured, when trying to save your response. Please contact administrators.';
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
