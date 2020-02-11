import Vue from 'vue';
import Reservation from './reservation/Reservation';
import Cancellation from './reservation/Cancellation';

new Vue({
  el: '#form-app',
  components: {
    Reservation,
    Cancellation
  },
  data: () => ({
    showRegistration: false
  }),
  methods: {
    toggleRegistration(show) {
      this.showRegistration = show;
    }
  }
});
