<template>
  <div class="arrivals">
    <p v-show="arrivingStudents !== null" class="alert alert-info">
      <strong>{{ percentageFilled }} %</strong>
      of arriving students filled their arrival date.
      <strong>{{ previousStudents }}</strong> exchange students are staying from
      previous semester.
    </p>

    <div class="row">
      <div class="col-sm-6">
        <h2>Arrival dates</h2>

        <stats-table key-field="arrival" :data="dates" :show-percents="false" />
      </div>
      <div class="col-sm-6">
        <h2>Transportations</h2>

        <stats-table key-field="transport" :data="transports" />
      </div>
    </div>
  </div>
</template>

<script>
import StatsTable from '../components/StatsTable';
import { getStudentCounts, getArrivals, cached } from '../api';
import { toStatsCollection } from '../utils/collections';

export default {
  components: {
    StatsTable
  },
  props: {
    semester: { type: String, required: true }
  },
  data: () => ({
    dates: null,
    transports: null,
    studentsWithFilledArrival: null,
    arrivingStudents: null,
    previousStudents: null,
    expanded: {}
  }),
  computed: {
    percentageFilled() {
      return Math.round(
        (this.studentsWithFilledArrival * 100) / this.arrivingStudents
      );
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      cached(getArrivals(this.semester)).then(data => {
        this.dates = this.groupDates(data.dates);
        this.transports = toStatsCollection(data.transports);
      });
      cached(getStudentCounts(this.semester)).then(data => {
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
        .padStart(2, '0')}.${parsed.getFullYear()} ${this.formatDay(date)}`;
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
