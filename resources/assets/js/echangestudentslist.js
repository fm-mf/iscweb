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

Vue.component('multiselect', VueMultiselect.default);
//Vue.component('vmultiselect', require('./components/Multiselect.vue'));
//Vue.component('exchangestudentstable', require('./components/ExchangeStudentsTable.vue'));

/** Which keys are used to identify selected option in filters list */
var filterToKey = {
  countries: 'id_country',
  faculties: 'id_faculty',
  accommodation: 'id_accommodation'
};

/**
 * Naive function that parses querystring input.
 * Anything separated by comma will be considered array.
 * @param {string} qs
 * @returns {{ [key: string]: string | string[] }}
 */
function parseQuery(qs) {
  if (qs.charAt(0) === '?') {
    qs = qs.substr(1);
  }

  return qs.split('&').reduce((acc, item) => {
    if (item.indexOf('=') < 0) {
      return acc;
    }

    var key = decodeURIComponent(item.substr(0, item.indexOf('=')));
    var value = decodeURIComponent(item.substr(item.indexOf('=') + 1));

    acc[key] = value.split(',');
    return acc;
  }, {});
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
      return preset
        .map(p => values.find(i => i[keyfield] == p))
        .filter(p => !!p);
    }
    return def;
  } else {
    return preset || def;
  }
}

const exchangeStudentsApp = new Vue({
  el: '#app',
  data: {
    countries: jscountries,
    faculties: jsfaculties,
    arrivals: jsdays,
    accommodation: jsaccommodation,

    page: 1,
    sortBy: 'arrival',
    filters: {
      countries: [],
      faculties: [],
      accommodation: [],
      arrivals: []
    },

    data: [],
    pagesCount: 1
  },

  created() {
    // Called when user moves between history entries
    window.addEventListener('popstate', this.updateFromQuery);

    this.updateFromQuery();
  },

  methods: {
    updateFromQuery() {
      const query = parseQuery(location.search);

      this.filters = {
        countries: loadFilter(
          jscountries,
          [],
          query.countries,
          filterToKey.countries
        ),
        faculties: loadFilter(
          jsfaculties,
          [],
          query.faculties,
          filterToKey.faculties
        ),
        accommodation: loadFilter(
          jsaccommodation,
          [],
          query.accommodation,
          filterToKey.accommodation
        ),
        arrivals: loadFilter(null, [], query.arrivals)
      };

      this.page = parseInt(query.page || '1', 10);
      this.update();
    },

    updateQuery() {
      const query = Object.keys(this.filters)
        .filter(key => this.filters[key] && this.filters[key].length > 0)
        .map(key => {
          var values = this.filters[key].map(v => {
            if (filterToKey[key] === undefined) {
              return v;
            }

            return v[filterToKey[key]];
          });

          return (
            encodeURIComponent(key) + '=' + encodeURIComponent(values.join(','))
          );
        });

      query.push('page=' + this.page);

      history.pushState(null, '', '?' + query.join('&'));
    },

    goToPage(num) {
      this.page = num;
      this.update();
      this.updateQuery();
    },

    filterChanged() {
      this.update();
      this.updateQuery();
    },

    update() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: '/api/liststudents',
        method: 'post',
        dataType: 'json',
        data: {
          filters: this.filters,
          page: this.page,
          sortBy: this.sortBy
        }
      })
        .done(newData => {
          this.data = newData.data;
          this.page = newData.current_page;
          this.pagesCount = newData.last_page;
        })
        .fail(error => {
          alert('Unable to fetch students - ' + error);
        });
    }
  }
});
