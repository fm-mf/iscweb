<template>
  <div class="cancellation">
    <loader :loaded="!loading" />

    <error :error="error" />

    <div v-if="!cancelled">
      <p>Are you sure you want to cancel your reservation for this event?</p>
      <button class="danger" @click="cancelReservation">
        Yes, cancel my reservation
      </button>
    </div>
    <div v-else>
      <div class="done-message">
        <div class="icon">
          <i class="fas fa-check" />
        </div>
        <span>Your reservation was cancelled</span>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from '../components/Loader';
import Error from './components/Error';
import { cancelReservation } from '../api/index';

export default {
  components: {
    Loader,
    Error
  },
  props: {
    hash: String
  },
  data: () => ({
    loading: false,
    cancelled: false,
    error: null
  }),
  methods: {
    cancelReservation() {
      this.loading = true;
      this.error = null;

      cancelReservation(this.hash).then(
        () => {
          this.loading = false;
          this.cancelled = true;
        },
        e => {
          this.loading = false;
          this.error =
            (e.response && e.response.data && e.response.data.message) || e;
        }
      );
    }
  }
};
</script>

<style scoped>
.cancellation {
  padding: 0.8rem 1.5rem;
  margin-bottom: 2rem;
  position: relative;

  text-align: center;
}
</style>
