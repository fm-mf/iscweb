<template>
  <table class="stats-table">
    <tr v-if="!data">
      <td colspan="99">
        <Loader />
      </td>
    </tr>
    <template v-for="item in data.items" v-else>
      <tr
        :key="item[keyField]"
        :class="{
          expandable: item.children && item.children.items.length > 0,
          expaned: expanded[item[keyField]]
        }"
        @click="
          item.children &&
            item.children.items.length > 0 &&
            toggle(item[keyField])
        "
      >
        <td class="s-label">
          {{ item[keyField] }}
        </td>
        <td v-if="showCount" class="count">
          {{ item.count }}
        </td>
        <td v-if="showPercents" class="percents">
          {{ Math.round((item.count * 100) / data.total) }} %
        </td>
        <td v-if="showHistogram" class="histogram">
          <div
            class="stats-bar"
            :style="`width: ${(item.count / data.max) * 100}px`"
          />
        </td>
      </tr>
      <tr v-if="expanded[item[keyField]]" :key="`${item[keyField]}-children`">
        <td colspan="999">
          <table class="sub-table">
            <tr v-for="child in item.children.items" :key="child.arrival">
              <td class="s-label">
                {{ child[keyField] }}
              </td>
              <td class="count">
                {{ child.count }}
              </td>
              <td v-if="showPercents" class="percents">
                {{ Math.round((child.count * 100) / item.children.total) }} %
              </td>
              <td class="histogram">
                <div
                  class="stats-bar"
                  :style="`width: ${(child.count / item.children.max) * 100}%`"
                />
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </template>
  </table>
</template>

<script>
import Vue from 'vue';
import Loader from '../components/Loader';

export default {
  components: {
    Loader
  },
  props: {
    data: {
      type: Object,
      required: false,
      default: null
    },
    keyField: {
      type: String,
      required: true
    },
    showHistogram: { type: Boolean, required: false, default: true },
    showCount: { type: Boolean, required: false, default: true },
    showPercents: { type: Boolean, required: false, default: true }
  },
  data: () => ({
    expanded: {}
  }),
  methods: {
    toggle(key) {
      Vue.set(this.expanded, key, !this.expanded[key]);
    },
    formatDate(date) {
      const parsed = new Date(date);

      return `${parsed
        .getDate()
        .toString()
        .padStart(2, '0')}.${(parsed.getMonth() + 1)
        .toString()
        .padStart(2, '0')}.${parsed.getFullYear()}`;
    },
    formatDay(date) {
      const parsed = new Date(date);
      const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

      return days[parsed.getDay()];
    }
  }
};
</script>

<style lang="scss" scoped>
.stats-table {
  tr {
    &.clickable {
      cursor: pointer;
    }
  }

  td {
    padding: 0.1rem 0.5rem;

    &.count {
      padding-left: 1.5rem;
      text-align: right;
    }

    &.percents {
      text-align: right;
    }

    &.histogram {
      vertical-align: middle;
    }

    .stats-bar {
      background: #6868ff;
      height: 15px;

      animation-name: initialize-x;
      animation-duration: 1s;
      transform-origin: center left;
    }
  }
}

.sub-table {
  margin-left: 1rem;
  animation-name: initialize-y;
  animation-duration: 200ms;
  transform-origin: top center;
  width: 100%;

  .date,
  .count {
    width: 0px;
  }

  .date {
    text-align: right;
  }

  .histogram {
    width: 150px;
  }

  .stats-bar {
    background: #7dacf3;
  }
}

@keyframes initialize-x {
  0% {
    transform: scaleX(0);
  }
  100% {
    transform: scaleX(1);
  }
}

@keyframes initialize-y {
  0% {
    transform: scaleY(0);
  }
  100% {
    transform: scaleY(1);
  }
}
</style>
