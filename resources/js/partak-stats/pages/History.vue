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
                    <th class="numeric pr-2">
                        With ESNcard
                    </th>
                    <th class="numeric pl-0">
                        %
                    </th>
                    <th class="numeric">
                        Buddies
                    </th>
                    <th class="numeric">
                        With profile
                    </th>
                    <th class="numeric pr-2">
                        With buddy
                    </th>
                    <th class="numeric pl-0">
                        %
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in semesters" :key="item.semester.id">
                    <td>{{ item.semester.name }}</td>
                    <td class="numeric">
                        {{ item.data.arriving_students }}
                    </td>
                    <td class="numeric pr-2">
                        {{ item.data.students_with_esncard }}
                    </td>
                    <td class="numeric pl-0 small text-muted text-nowrap">
                        {{
                            item.data.arriving_students > 0
                                ? percentage(
                                      item.data.students_with_esncard,
                                      item.data.arriving_students
                                  )
                                : null
                        }}
                    </td>
                    <td class="numeric">
                        {{ item.data.total_buddies }}
                    </td>
                    <td class="numeric">
                        {{ item.data.students_with_profile }}
                    </td>
                    <td class="numeric pr-2">
                        {{ item.data.students_with_buddy }}
                    </td>
                    <td class="numeric pl-0 small text-muted text-nowrap">
                        {{
                            item.data.students_with_profile > 0
                                ? percentage(
                                    item.data.students_with_buddy,
                                    item.data.students_with_profile
                                )
                                : null
                        }}
                    </td>
                </tr>
                <tr class="totals">
                    <td>Total</td>
                    <td class="numeric">
                        {{ totals.arriving_students }}
                    </td>
                    <td class="numeric pr-2">
                        {{ totals.students_with_esncard }}
                    </td>
                    <td class="numeric pl-0 small text-muted text-nowrap">
                        {{
                            totals.arriving_students > 0
                                ? percentage(
                                    totals.students_with_esncard,
                                    totals.arriving_students
                                )
                                : null
                        }}
                    </td>
                    <td class="numeric">
                        {{ totals.buddies }}
                    </td>
                    <td class="numeric">
                        {{ totals.students_with_profile }}
                    </td>
                    <td class="numeric pr-2">
                        {{ totals.students_with_buddy }}
                    </td>
                    <td class="numeric pl-0 small text-muted text-nowrap">
                        {{
                            totals.students_with_profile > 0
                                ? percentage(
                                    totals.students_with_buddy,
                                    totals.students_with_profile
                                )
                                : null
                        }}
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
                    (acc, i) => acc + i.data.total_buddies,
                    0
                ),
                students_with_profile: this.semesters.reduce(
                    (acc, i) => acc + i.data.students_with_profile,
                    0
                ),
                students_with_buddy: this.semesters.reduce(
                    (acc, i) => acc + i.data.students_with_buddy,
                    0
                ),
                students_with_esncard: this.semesters.reduce(
                    (acc, i) => acc + i.data.students_with_esncard,
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
        },
        percentage(value, total) {
            return Math.floor((value * 100) / total) + ' %';
        }
    }
};
</script>

<style lang="scss" scoped>
.no-data {
    color: #666;
}

td {
    vertical-align: bottom;
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
