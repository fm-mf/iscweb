import Vue from 'vue';
import VueMultiselect from 'vue-multiselect';
import ProtectedSubmitButton from "./components/ProtectedSubmitButton";

if (document.getElementById('vue-form')) {
    new Vue({
        el: "#vue-form",
        components: {
            VueMultiselect,
        },
        data() {
            return {
                initValues: initValues,
                country: null,
                languagesToLearn: [],
                languagesToTeach: [],
            };
        },
        computed: {
            countryId() {
                return this.country?.id_country;
            },
        },
        mounted() {
            this.country = this.initValues?.country ?? null;
            this.languagesToLearn = this.initValues?.languagesToLearn ?? [];
            this.languagesToTeach = this.initValues?.languagesToTeach ?? [];
        },
    });
}

if (document.getElementById('delete-account-form')) {
    new Vue({
        el: "#delete-account-form",
        components: {
            ProtectedSubmitButton,
        },
    });
}
