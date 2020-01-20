import Vue from 'vue';
import PartakStats from './partak-stats/PartakStats';
import VueRouter from 'vue-router';
import routes from './partak-stats/routes';

Vue.use(VueRouter);

const router = new VueRouter({
  routes
});

new Vue({
  el: '#stats-app',
  router,
  components: { PartakStats }
});
