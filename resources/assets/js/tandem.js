import Vue from 'vue';
import VueMultiselect from 'vue-multiselect';

const vueForm = new Vue({
    el: "#vue-form",
    components: {
        VueMultiselect,
    },
    data() {
        return {
            languagesToLearn: [],
            languagesToTeach: [],
            country: null,
        }
    },
    computed: {
        countryId() {
            return this.country == null ? null : this.country.id_country;
        },
    },
});
