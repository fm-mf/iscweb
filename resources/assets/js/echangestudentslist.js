
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

Vue.component('multiselect', VueMultiselect.default)
//Vue.component('vmultiselect', require('./components/Multiselect.vue'));
//Vue.component('exchangestudentstable', require('./components/ExchangeStudentsTable.vue'));


class ExchangeStudents {
    constructor (url = null) {

        this.data = [];

        this.filters = {
            countries: [],
            faculties: [],
            accommodation: [],
            arrivals: [],
            sex: []
        };

        this.sortBy = 'first_name';
        this.page = 1;
        this.pagesCount = 1;
        this.lastPage = 1;
    }

    update() {
        var _this = this;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: ('/api/liststudents'),
            method: 'post',
            dataType: 'json',
            data: {
                filters: this.filters,
                page: this.page,
                sortBy: this.sortBy
            },
        }).done(function(newData) {
            console.log(newData);
            _this.data = newData.data;
            _this.page = newData.current_page;
            _this.pagesCount = newData.last_page;
        }).fail(function(error) {
            alert('error');
        });
    }

    onFilterChanged() {
        this.page = 1;
        this.update();
    }

    goToPage(page) {
        this.page = page;
        this.update();
    }

    all() {
        return this.data;
    }


}

const exchangeStudentsApp = new Vue({
    el: '#app',
    data: {
        columns: [
            { key: 'first_name', title: 'Jméno' },
            { key: 'last_name', title: 'Příjmení' }
        ],
        exchangeStudents : new ExchangeStudents(),
        selected: null,
        countries: jscountries,
        faculties: jsfaculties,
        arrivals: jsdays,
        accommodation: jsaccommodation
    },
    ready: function() {
        alert('ready');
    },
    methods: {
        page: function (num) {
            this.exchangeStudents.goToPage(num)
        },
        update: function() {
            this.exchangeStudents.onFilterChanged();
        },
    },
    created: function() {
        console.log(jscountries);
      this.exchangeStudents.update();
    }

});