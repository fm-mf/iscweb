<template>
  <div class="box-container">
    <div class="trip-card" :style="{ backgroundImage: `url('${trip.cover}')` }">
      <div class="trip-head">{{ trip.name }}</div>
      <div class="trip-body">
        <div :class="{ 'trip-free': !trip.full, 'trip-full': trip.full }">
          <template v-if="trip.full">
            FULL
          </template>
          <template v-else>
            {{ Math.max(0, trip.free) }}
            {{ trip.free === 1 ? 'SPOT' : 'SPOTS' }}
          </template>
        </div>
      </div>
      <div class="trip-foot">
        <a class="trip-url" :href="trip.url">
          {{ trip.url }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    trip: {
      type: Object,
      required: true
    }
  }
};
</script>

<style lang="scss" scoped>
.box-container {
  padding: 1rem;
  width: 50%;
}

.trip-card {
  background-position: center center;
  position: relative;
  font-size: 200%;
  text-align: center;

  .trip-head {
    background: rgba(255, 255, 255, 0.9);
    padding: 0.5rem 1rem;
    font-weight: bold;
    /*
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    */
  }

  .trip-body {
    display: flex;
    justify-content: center;

    > div {
      background: rgba(200, 200, 200, 0.8);
      padding: 0.5rem 1rem;
      font-weight: bold;

      &.trip-free {
        background: rgba(0, 150, 0, 0.9);
        color: #fff;
      }

      &.trip-full {
        background: rgba(200, 50, 50, 0.9);
        color: #fff;
      }
    }
  }

  .trip-foot {
    background: rgba(255, 255, 255, 0.9);
    padding: 0.5rem 1rem;

    .trip-url {
      color: #105cc0;
    }
  }
}
</style>
