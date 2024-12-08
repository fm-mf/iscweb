<template>
    <loader class="buddies" :active="buddies.loading" absolute>
        <h2>Top buddies</h2>

        <div v-if="splitBuddies" class="row">
            <div
                v-for="(buddies, colIndex) in splitBuddies"
                :key="colIndex"
                class="col-lg-3"
            >
                <table class="b-table">
                    <tr v-for="(buddy, index) in buddies" :key="index">
                        <td>
                            <a
                                :href="`/partak/users/buddies/${buddy.id_user}`"
                                >{{
                                    `${buddy.last_name}, ${buddy.first_name}`
                                }}</a>
                            <span
                                v-if="buddy.partak"
                                class="partak"
                                title="Partak"
                                >(P)</span>
                        </td>
                        <td>{{ buddy.exchange_students_count }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <h2 class="mt-3">By faculty</h2>
                <stats-table
                    :data="byFaculty"
                    key-field="faculty"
                />
            </div>
        </div>
    </loader>
</template>

<script>
import { getBuddies, cached, emptyPromised, promised } from '../api';
import StatsTable from '../components/StatsTable.vue';
import { toStatsCollection } from "../utils/collections";

export default {
    components: { StatsTable },
    props: { semester: { type: String, required: true } },
    data: () => ({
        buddies: emptyPromised(),
        byFaculty: null
    }),
    computed: {
        splitBuddies() {
            return (
                this.buddies.data &&
                this.buddies.data.list &&
                this.buddies.data.list.reduce(
                    (cols, buddy) => {
                        const currentCol = cols[cols.length - 1];

                        currentCol.push(buddy);

                        if (currentCol.length > this.buddies.data.list.length / 4) {
                            cols.push([]);
                        }
                        return cols;
                    },
                    [[]]
                )
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
            this.buddies = promised(cached(getBuddies(this.semester)))
                .then(data => {
                    this.byFaculty = toStatsCollection(data.by_faculty);
                });
        }
    }
};
</script>

<style lang="scss" scoped>
.b-table {
    width: 100%;
    max-width: 300px;

    td {
        padding: 0.1rem 0.5rem;

        .partak {
            float: right;
            color: #999;
        }
    }
}
</style>
