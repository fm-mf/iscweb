
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('autocomplete', require('./components/Autocomplete.vue'))
Vue.component('multiselectinput', require('./components/MultiSelectInput.vue'))
Vue.component('protectedbutton', require('./components/Button.vue'))
Vue.component('preregister', require('./components/Preregister.vue'))
Vue.component('unique-url', require('./components/UniqueUrlCopy.vue'))

if (typeof jsoptions === 'undefined') {
    jsoptions = [];
}

const partak = new Vue({
    el: '#partakApp',
    data: {
        options: jsoptions,
    },
    methods: {
    },
});