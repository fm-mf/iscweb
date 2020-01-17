import Vue from 'vue';
import axios from 'axios';
import OrderableColumn from './components/OrderableColumn';
import VueMultiselect from 'vue-multiselect';

Vue.component('multiselect', VueMultiselect);

/** Which keys are used to identify selected option in filters list */
const filterToKey = {
  countries: 'id_country',
  faculties: 'id_faculty',
  accommodation: 'id_accommodation',
  arrivals: 'date'
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

    const key = decodeURIComponent(item.substr(0, item.indexOf('=')));
    const value = decodeURIComponent(item.substr(item.indexOf('=') + 1));

    acc[key] = value.split(',');
    return acc;
  }, {});
}

/**
 * Loads filter value from preset and tries to map it values using keyfield (if provided).
 * @param {any[]} values
 * @param {any[]} preset
 * @param {string} keyfield
 * @returns {any[]}
 */
function loadFilter(values, preset, keyfield) {
  if (keyfield) {
    if (preset) {
      return preset
        .map(p => values.find(i => i[keyfield] == p))
        .filter(p => !!p);
    }
    return [];
  } else {
    return preset || [];
  }
}

/**
 * Maps filters to its unique identifiers and removes empty filters
 * @param {{ [filter: string]: any[] }} filters
 * @returns {{ [filter: string]: (string | number)[] }}
 */
const simplifyFilters = filters =>
  Object.keys(filters)
    .filter(key => filters[key] && filters[key].length > 0)
    .reduce((acc, key) => {
      if (filterToKey[key]) {
        acc[key] = filters[key].map(f => f[filterToKey[key]]);
      } else {
        acc[key] = filters[key];
      }
      return acc;
    }, {});

new Vue({
  el: '#app',
  components: { OrderableColumn },

  data: () => ({
    countries: [],
    faculties: [],
    arrivals: [],
    accommodation: [],

    loading: true,
    page: 1,
    sortBy: { field: 'arrival', order: 'asc' },
    filters: {
      countries: [],
      faculties: [],
      accommodation: [],
      arrivals: []
    },

    data: [],
    pagesCount: 1
  }),

  created() {
    // Called when user moves between history entries
    window.addEventListener('popstate', this.updateFromQuery);

    this.loadFilterOptions();
  },

  methods: {
    loadFilterOptions() {
      axios.get(`/api/filter-options`)
        .then((response) => {
          this.countries = response.data.countries;
          this.faculties = response.data.faculties;
          this.arrivals = response.data.days;
          this.accommodation = response.data.accommodation;

          this.updateFromQuery();
        })
        .catch((error) => {
          console.error("Failed to load filter options");
          console.error(error);
        })
    },

    updateFromQuery() {
      const query = parseQuery(location.search);

      this.filters = {
        countries: loadFilter(
          this.countries,
          query.countries,
          filterToKey.countries
        ),
        faculties: loadFilter(
          this.faculties,
          query.faculties,
          filterToKey.faculties
        ),
        accommodation: loadFilter(
          this.accommodation,
          query.accommodation,
          filterToKey.accommodation
        ),
        arrivals: loadFilter(
          this.arrivals,
          query.arrivals,
          filterToKey.arrivals
        )
      };

      this.page = parseInt(query.page || '1', 10);

      if (query.sort && Array.isArray(query.sort)) {
        const [field, order] = query.sort;
        this.sortBy = {
          field,
          order: order !== 'desc' ? 'asc' : 'desc'
        };
      }

      this.update();
    },

    updateQuery() {
      const filters = simplifyFilters(this.filters);
      const query = Object.keys(filters).map(
        key =>
          encodeURIComponent(key) +
          '=' +
          encodeURIComponent(filters[key].join(','))
      );

      query.push('page=' + this.page);
      query.push('sort=' + this.sortBy.field + ',' + this.sortBy.order);

      history.pushState(null, '', '?' + query.join('&'));
    },

    goToPage(num) {
      this.page = num;
      this.update();
      this.updateQuery();
    },

    filterChanged() {
      this.goToPage(1);
    },

    update() {
      this.loading = true;
      axios
        .post(
          '/api/liststudents',
          {
            filters: simplifyFilters(this.filters),
            page: this.page,
            sortBy: this.sortBy
          },
          {
            headers: {
              'X-Requested-With': 'XMLHttpRequest',
            }
          }
        )
        .then(res => {
          const data = res.data;

          this.data = data.data;
          this.page = data.meta.current_page;
          this.pagesCount = data.meta.last_page;

          this.loading = false;
        })
        .catch(err => {
          console.error(err);
          alert('Failed to load list of students: ' + err);

          this.loading = false;
        });
    }
  }
});
