
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

//Vue.component('example', require('./components/Example.vue'));
Vue.component('exchangestudentstable', require('./components/ExchangeStudentsTable.vue'));


class ExchangeStudents {
    constructor (url = null) {

        this.data = [
           // { person: {first_name : 'Michal', last_name: 'Kral'} },
        ];

        this.filters = {
            nationality: [1, 2, 3],
            faculty: [1, 2, 3],
            school: [],
            sex : [],
        };

        this.sortBy = 'name';

        this.page = 1;
        this.pagesCount;
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
            _this.pagesCount = newData.pages;
        }).fail(function(error) {
            alert('error');
        });
    }

    changePage(page) {

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
        exchangeStudents : new ExchangeStudents()
    },
    methods: {
        update: function() {
            this.exchangeStudents.update();
        }
    }

});