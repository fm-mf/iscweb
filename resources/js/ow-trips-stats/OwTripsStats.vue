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
        running: true
    }),
    created() {
        this.load();
    },
    destroyed() {
        this.running = false;
    },
    methods: {
        load() {
            if (this.running) {
                getOwTrips().then(
                    trips => {
                        this.trips = trips;
                        setTimeout(() => {
                            this.load();
                        }, 2000);
                    },
                    () =>
                        setTimeout(() => {
                            this.load();
                        }, 2000)
                );
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.ow-trips {
    padding: 1rem 1rem;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}
</style>
