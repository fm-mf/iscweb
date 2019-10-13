import Vue from 'vue';
import Preregistration from './preregistration/Preregistration';

new Vue({
  el: '#form-app',
  components: {
    Preregistration
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
