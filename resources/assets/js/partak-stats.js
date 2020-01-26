import Vue from 'vue';
import PartakStats from './partak-stats/PartakStats';
import Loader from './partak-stats/components/Loader';
import VueRouter from 'vue-router';
import routes from './partak-stats/routes';

Vue.use(VueRouter);
Vue.component('loader', Loader);

const router = new VueRouter({
  routes
});

new Vue({
  el: '#stats-app',
  router,
  components: { PartakStats }
});
