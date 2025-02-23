import Vue from 'vue';
import PartakStats from './partak-stats/PartakStats';
import Loader from './partak-stats/components/Loader';
import VueRouter from 'vue-router';
import routes from './partak-stats/routes';

Vue.use(VueRouter);
Vue.component('Loader', Loader);

const router = new VueRouter({
    mode: 'history',
    base: '/partak/stats',
    routes
});

new Vue({
    el: '#stats-app',
    router,
    components: { PartakStats }
});
