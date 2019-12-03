/* global jsoptions:readonly */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import Vue from 'vue';
import Autocomplete from './components/Autocomplete';
import MultiSelectInput from './components/MultiSelectInput';
import Button from './components/Button';
import PreRegister from './components/Preregister';
import UniqueUrlCopy from './components/UniqueUrlCopy';
import Reservation from './partak/Reservation';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('autocomplete', Autocomplete);
Vue.component('multiselectinput', MultiSelectInput);
Vue.component('protectedbutton', Button);
Vue.component('preregister', PreRegister);
Vue.component('unique-url', UniqueUrlCopy);

new Vue({
  el: '#partakApp',
  components: {
    Reservation
  },
  data: {
    options: typeof jsoptions !== 'undefined' ? jsoptions : []
  },
  methods: {}
});
