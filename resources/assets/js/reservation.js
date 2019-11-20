import Vue from 'vue';
import Reservation from './reservation/Reservation';

new Vue({
  el: '#form-app',
  components: {
    Reservation
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
