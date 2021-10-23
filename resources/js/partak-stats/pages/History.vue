<template>
    <div class="history">
        <loader :active="loading" absolute />

        <table class="table">
            <thead>
                <tr>
                    <th>Semester</th>
                    <th class="numeric">
                        Students
                    </th>
                    <th class="numeric">
                        Buddies
                    </th>
                    <th class="numeric">
                        With profile
                    </th>
                    <th class="numeric">
                        With buddy
                    </th>
                    <th class="numeric">
                        With buddy / With profile
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in semesters" :key="item.semester.id">
                    <td>{{ item.semester.name }}</td>
                    <td class="numeric">
                        {{ item.data.arriving_students }}
                    </td>
                    <td class="numeric">
                        {{ item.data.buddies }}
                    </td>
                    <td class="numeric">
                        {{ item.data.students_with_profile }}
                    </td>
                    <td class="numeric">
                        {{ item.data.students_with_buddy }}
                    </td>
                    <td class="numeric">
                        <span v-if="item.data.students_with_profile > 0">
                            {{
                                Math.round(
                                    (item.data.students_with_buddy * 100) /
                                        item.data.students_with_profile
                                )
                            }}
                            %
                        </span>
                    </td>
                </tr>
                <tr class="totals">
                    <td>Total</td>
                    <td class="numeric">
                        {{ totals.arriving_students }}
                    </td>
                    <td class="numeric">
                        {{ totals.buddies }}
                    </td>
                    <td class="numeric">
                        {{ totals.students_with_profile }}
                    </td>
                    <td class="numeric">
                        {{ totals.students_with_buddy }}
                    </td>
                    <td class="numeric">
                        <span v-if="totals.students_with_profile > 0">
                            {{
                                Math.round(
                                    (totals.students_with_buddy * 100) /
                                        totals.students_with_profile
                                )
                            }}
                            %
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
/* eslint-disable @typescript-eslint/camelcase */
import { cached, getSemesters, getStudentCounts } from '../api';
import Loader from '../components/Loader';

export default {
    components: {
        Loader
    },
    data: () => ({
        semesters: null,
        loading: false
    }),
    computed: {
        totals() {
            if (!this.semesters) {
                return {};
            }

            return {
                arriving_students: this.semesters.reduce(
                    (acc, i) => acc + i.data.arriving_students,
                    0
                ),
                buddies: this.semesters.reduce(
                    (acc, i) => acc + i.data.buddies,
                    0
                ),
                students_with_profile: this.semesters.reduce(
                    (acc, i) => acc + i.data.students_with_profile,
                    0
                ),
                students_with_buddy: this.semesters.reduce(
                    (acc, i) => acc + i.data.students_with_buddy,
                    0
                )
            };
        }
    },
    created() {
        this.load();
    },
    methods: {
        load() {
            this.loading = true;

            cached(getSemesters())
                .then(data =>
                    Promise.all(
                        data.map(semester =>
                            cached(getStudentCounts(semester.id)).then(
                                data => ({
                                    semester,
                                    data
                                })
                            )
                        )
                    )
                )
                .then(semesters => {
                    this.semesters = semesters;
                    this.loading = false;
                });
        }
    }
};
</script>

<style lang="scss" scoped>
.no-data {
    color: #666;
}

td.numeric,
th.numeric {
    text-align: right;
}

.totals {
    td {
        font-weight: bold;
        border-top: 2px solid #ddd;
    }
}
</style>
