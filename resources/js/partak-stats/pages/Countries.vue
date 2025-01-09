<template>
    <loader :active="countries.loading" absolute>
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <h2>Countries stats</h2>
                <stats-table
                    :data="countriesStats"
                    key-field="id"
                    label-field="name"
                    class="table table-striped countries-stats"
                >
                </stats-table>
            </div>
        </div>
    </loader>
</template>

<script>
import { getCountries, cached, emptyPromised, promised } from '../api';
import StatsTable from '../components/StatsTable';
import { toStatsCollection } from '../utils/collections';

export default {
    components: { StatsTable },
    props: { semester: { type: String, required: true } },
    data: () => ({
        countries: emptyPromised(),
    }),
    computed: {
        countriesStats() {
            return (
                this.countries.data && toStatsCollection(this.countries.data)
            );
        }
    },
    watch: {
        semester() {
            return this.load();
        }
    },
    created() {
        this.load();
    },
    methods: {
        load() {
            this.countries = promised(cached(getCountries(this.semester)));
        }
    },
};
</script>

<style lang="scss" scoped>
.countries-stats::v-deep {
    td {
        padding: 0.75rem;
    }
    td.s-label {
        font-weight: bold;
    }
}
</style>
