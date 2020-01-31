<template>
  <table class="stats-table">
    <tr v-if="!data">
      <td colspan="99">
        <loader />
      </td>
    </tr>
    <tr v-if="data && data.items && data.items.length === 0">
      <td colspan="99" class="no-data">
        No data
      </td>
    </tr>
    <template v-for="item in (data && data.items) || []">
      <tr
        :key="item[keyField]"
        :class="{
          expandable: item.children,
          expaned: expanded[item[keyField]]
        }"
        @click="item.children && toggle(item)"
      >
        <td class="s-label">
          {{ item[keyField] }}
        </td>
        <td v-if="showCount" class="count">
          {{ item.count }}
        </td>
        <td v-if="showPercents" class="percents">
          {{
            data.total > 0 ? Math.round((item.count * 100) / data.total) : '-'
          }}
          %
        </td>
        <td v-if="showHistogram" class="histogram">
          <div
            class="stats-bar"
            :style="`width: ${(item.count / data.max) * 100}px`"
          />
        </td>
      </tr>
      <transition :key="`${item[keyField]}-children`" name="expand">
        <tr
          v-if="expanded[item[keyField]]"
          :key="`${item[keyField]}-children`"
          class="expanded-children"
        >
          <td colspan="999">
            <table v-if="typeof item.children !== 'function'" class="sub-table">
              <tr v-for="child in item.children.items" :key="child.arrival">
                <td class="s-label">
                  {{ child[keyField] }}
                </td>
                <td class="count">
                  {{ child.count }}
                </td>
                <td v-if="showPercents" class="percents">
                  {{
                    item.children.total > 0
                      ? Math.round((child.count * 100) / item.children.total)
                      : '-'
                  }}
                  %
                </td>
                <td class="histogram">
                  <div
                    class="stats-bar"
                    :style="
                      `width: ${(child.count / item.children.max) * 100}%`
                    "
                  />
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </transition>
    </template>
  </table>
</template>

<script>
import Vue from 'vue';

export default {
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
    toggle(item) {
      const key = item[this.keyField];
      Vue.set(this.expanded, key, !this.expanded[key]);
      if (this.expanded[key] && item.children instanceof Function) {
        item.children().then(data => {
          item.children = data;
        });
      }
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
    &.expandable {
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

  .expanded-children {
    transform-origin: top center;
  }

  .sub-table {
    margin-left: 1rem;
    width: 100%;

    color: #999;

    .s-label,
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
      height: 10px;
    }
  }
}

.no-data {
  text-align: center;
  padding: 1rem 0;
}

.expand-enter {
  transform: scaleY(0);
}

.expand-enter-to {
  transform: scaleY(1);
}

.expand-leave-to {
  transform: scaleY(0);
}

.expand-enter-active,
.expand-leave-active {
  transition: all 0.2s;
}

@keyframes initialize-x {
  0% {
    transform: scaleX(0);
  }
  100% {
    transform: scaleX(1);
  }
}
</style>
