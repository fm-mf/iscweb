
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

/** Which keys are used to identify selected option in filters list */
var filterToKey = {
    countries: 'id_country',
    faculties: 'id_faculty',
    accommodation: 'id_accommodation'
}

/**
 * Naive function that parses querystring input.
 * Anything separated by comma will be considered array.
 * @param {string} qs
 * @returns {{ [key: string]: string | string[] }} 
 */
function parseQuery(qs) {
    if (qs.charAt(0) === '?') {
        qs = qs.substr(1)
    }

    return qs.split('&')
        .reduce(function (acc, item) {
            if (item.indexOf('=') < 0) {
                return
            }

            var key = decodeURIComponent(item.substr(0, item.indexOf('=')))
            var value = decodeURIComponent(item.substr(item.indexOf('=') + 1))

            acc[key] = value.split(',')
            return acc
        }, {})
}

/**
 * Loads filter value from preset and tries to map it values using keyfield (if provided).
 * @param {any[]} values 
 * @param {any[]} def 
 * @param {any[]} preset
 * @param {string} keyfield
 * @returns {any[]}
 */
function loadFilter(values, def, preset, keyfield) {
    if (keyfield) {
        if (preset) {
            return preset.map(function (p) { return values.find(i => i[keyfield] == p) })
                .filter(function (p) { return !!p })
        }
        return def
    } else {
        return preset || def
    }
}

class ExchangeStudents {
    constructor (url = null) {
        // Called when user moves between history entries
        window.addEventListener('popstate', this.onPopState.bind(this))

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

    onPopState() {
        this.updateFromQuery()
    }

    updateFromQuery() {
        var query = parseQuery(location.search)

        this.filters.countries = loadFilter(jscountries, [], query.countries, filterToKey.countries)
        this.filters.faculties = loadFilter(jsfaculties, [], query.faculties, filterToKey.faculties)
        this.filters.accommodation = loadFilter(jsaccommodation, [], query.accommodation, filterToKey.accommodation)
        this.filters.arrivals = loadFilter(null, [], query.arrivals)
        this.page = parseInt(query.page || '1', 10)

        this.update()
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
        this.updateQuery();
    }
    
    updateQuery() {
        var _this = this;

        var query = Object.keys(_this.filters)
            .filter(function (key) { return _this.filters[key] && _this.filters[key].length > 0 })
            .map(function (key) {
                var values = _this.filters[key].map(function (v) {
                    if (filterToKey[key] === undefined) {
                        return v
                    }

                    return v[filterToKey[key]]
                })

                return encodeURIComponent(key) + '=' + encodeURIComponent(values.join(','))
            })
        
        query.push('page=' + _this.page);

        history.pushState(null, '', '?' + query.join('&'));
    }

    goToPage(page) {
        this.page = page;
        this.update();
        this.updateQuery();
    }

    all() {
        return this.data;
    }


}

var exchangeStudentsApp = new Vue({
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
    methods: {
        page: function (num) {
            this.exchangeStudents.goToPage(num)
        },
        update: function() {
            this.exchangeStudents.onFilterChanged();
        },
    },
    created: function() {
        this.exchangeStudents.updateFromQuery();
    }

});