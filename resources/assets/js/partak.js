
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('autocomplete', require('./components/Autocomplete.vue'))
Vue.component('multiselectinput', require('./components/MultiSelectInput.vue'))
Vue.component('protectedbutton', require('./components/Button.vue'))

const partak = new Vue({
    el: '#partakApp',
    data: {

    },
    methods: {
    },
});