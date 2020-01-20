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

        <table>
          <tr v-for="date in groupedDates" :key="date.arrival">
            <td class="date">
              {{ date.arrival }}
            </td>
            <td class="count">
              {{ date.count }}
            </td>
            <td class="histogram">
              <div
                class="stats-bar"
                :style="`width: ${(date.count / arrivalsMax) * 150}px`"
              />
            </td>
          </tr>
        </table>
      </div>
      <div class="col-sm-6">
        <h2>Transportations</h2>

        <table>
          <tr v-for="transport in transports" :key="transport.eng">
            <td class="date">
              {{ transport.eng }}
            </td>
            <td class="count">
              {{ transport.count }}
            </td>
            <td class="histogram">
              <div
                class="stats-bar"
                :style="`width: ${(transport.count / transportsMax) * 150}px`"
              />
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { getStudentCounts, getArrivals } from '../api';

export default {
  props: {
    semester: { type: String, required: true }
  },
  data: () => ({
    dates: null,
    transports: null,
    studentsWithFilledArrival: null,
    arrivingStudents: null,
    previousStudents: null
  }),
  computed: {
    percentageFilled() {
      return Math.round(
        (this.studentsWithFilledArrival * 100) / this.arrivingStudents
      );
    },
    groupedDates() {
      if (!this.dates) {
        return null;
      }

      return Object.values(
        this.dates.reduce((acc, date) => {
          const day = date.arrival.split(' ')[0];
          if (!acc[day]) {
            acc[day] = {
              arrival: day,
              count: 0,
              children: []
            };
          }

          acc[day].count += date.count;
          acc[day].children.push(date);

          return acc;
        }, {})
      );
    },
    arrivalsMax() {
      return (this.groupedDates || []).reduce(
        (max, item) => (item.count > max ? item.count : max),
        0
      );
    },
    transportsMax() {
      return (this.transports || []).reduce(
        (max, item) => (item.count > max ? item.count : max),
        0
      );
    }
  },
  created() {
    this.load();
  },
  methods: {
    load() {
      getArrivals(this.semester).then(data => {
        this.dates = data.dates;
        this.transports = data.transports;
      });
      getStudentCounts(this.semester).then(data => {
        this.studentsWithFilledArrival = data.students_with_arrival;
        this.arrivingStudents = data.arriving_students;
        this.previousStudents = data.students_from_previous;
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.stats-bar {
  animation-name: initialize;
  animation-duration: 1s;
  transform-origin: center left;
}

@keyframes initialize {
  0% {
    transform: scaleX(0);
  }
  100% {
    transform: scaleX(1);
  }
}
</style>
