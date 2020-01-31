<template>
  <div class="ow-trips">
    <trip v-for="trip in trips" :key="trip.id" :trip="trip" />
  </div>
</template>

<script>
import { getOwTrips } from '../api';
import Trip from './components/Trip';

export default {
  components: { Trip },
  data: () => ({
    trips: null,
    interval: null
  }),
  created() {
    this.load();
    this.interval = setInterval(() => {
      this.load();
    }, 1000);
  },
  destroyed() {
    clearInterval(this.interval);
  },
  methods: {
    load() {
      getOwTrips().then(trips => {
        this.trips = trips;
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.ow-trips {
  padding: 1rem 1rem;
  display: flex;
  flex-wrap: wrap;
}
</style>
