<template>
    <loader :active="counts.loading || arrivals.loading" absolute>
        <p v-if="arrivingStudents !== null" class="alert alert-info">
            <strong>{{ percentageFilled }} %</strong>
            of arriving students filled their arrival date.
            <strong>{{ previousStudents }}</strong> exchange students are
            staying from previous semester.
        </p>

        <div class="row">
            <div class="col-sm-6">
                <h2>Arrival dates</h2>

                <stats-table
                    key-field="arrival"
                    :data="dates"
                    :show-percents="false"
                />
            </div>
            <div class="col-sm-6">
                <h2>Transportations</h2>

                <stats-table key-field="type" :data="transports" />
            </div>
        </div>
    </loader>
</template>

<script>
import StatsTable from '../components/StatsTable';
import {
    getStudentCounts,
    getArrivals,
    cached,
    emptyPromised,
    promised
} from '../api';
import { toStatsCollection } from '../utils/collections';

export default {
    components: {
        StatsTable
    },
    props: {
        semester: { type: String, required: true }
    },
    data: () => ({
        studentsWithFilledArrival: null,
        arrivingStudents: null,
        previousStudents: null,
        counts: emptyPromised(),
        arrivals: emptyPromised()
    }),
    computed: {
        percentageFilled() {
            return this.arrivingStudents > 0
                ? Math.round(
                      (this.studentsWithFilledArrival * 100) /
                          this.arrivingStudents
                  )
                : '0';
        },
        dates() {
            return (
                this.arrivals.data && this.groupDates(this.arrivals.data.dates)
            );
        },
        transports() {
            return (
                this.arrivals.data &&
                toStatsCollection(this.arrivals.data.transports)
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
            this.arrivals = promised(cached(getArrivals(this.semester)));
            this.counts = promised(
                cached(getStudentCounts(this.semester))
            ).then(data => {
                this.studentsWithFilledArrival = data.students_with_arrival;
                this.arrivingStudents = data.arriving_students;
                this.previousStudents = data.students_from_previous;
            });
        },

        groupDates(dates) {
            return toStatsCollection(
                Object.values(
                    dates.reduce((acc, date) => {
                        const day = date.arrival.split(' ')[0];
                        let item = acc[day];

                        if (!item) {
                            item = acc[day] = {
                                arrival: this.formatDate(day),
                                count: 0,
                                children: [],
                                childrenMax: 0
                            };
                        }

                        item.count += date.count;
                        item.children.push({
                            ...date,
                            arrival: this.formatHour(date.arrival)
                        });

                        if (date.count > item.childrenMax) {
                            item.childrenMax = date.count;
                        }

                        return acc;
                    }, {})
                )
            );
        },

        formatDate(date) {
            const parsed = new Date(date);

            return `${parsed
                .getDate()
                .toString()
                .padStart(2, '0')}.${(parsed.getMonth() + 1)
                .toString()
                .padStart(2, '0')}.${parsed.getFullYear()} ${this.formatDay(
                date
            )}`;
        },

        formatDay(date) {
            const parsed = new Date(date);
            const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

            return days[parsed.getDay()];
        },

        formatHour(date) {
            const parsed = new Date(date);

            return (
                parsed
                    .getHours()
                    .toString()
                    .padStart(2, '0') +
                ':' +
                parsed
                    .getMinutes()
                    .toString()
                    .padStart(2, '0')
            );
        }
    }
};
</script>

<style lang="scss" scoped></style>
