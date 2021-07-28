
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

Vue.component('task', require('./components/Task.vue'));
Vue.component('task-list', require('./components/TaskList.vue'));


const testapp = new Vue({
    el: '#root',
    data: {
        tasks: [
            { description: 'Umyt pradlo', completed: true },
            { description: 'Uklidit pokoj', completed: false },
            { description: 'Napsat DU', completed: false },
            { description: 'Jit do skoly', completed: false },
        ],
    },
    methods: {
        addName() {
            this.isLoading = true;
            this.names.push(this.newName);
            this.newName = '';
            this.isLoading = true;
        }
    },

    computed: {
        incomplete_tasks() {
            return this.tasks.filter(task => !task.completed);
        },

        completedTasks() {
            return this.tasks.filter(task => task.completed);
        },
    }
});