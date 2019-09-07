<template>
  <div
    :class="[
      'orderable-column',
      { [`is-${value && value.order}`]: value && value.field === field }
    ]"
    @click="clicked"
  >
    <slot />
    <i class="order-asc fas fa-caret-up" />
    <i class="order-desc fas fa-caret-down" />
  </div>
</template>

<script>
export default {
  props: {
    value: {
      type: Object,
      default: () => ({ field: null, order: 'asc' })
    },
    field: {
      type: String,
      required: true
    }
  },
  methods: {
    clicked() {
      if (this.value && this.value.field === this.field) {
        this.$emit('input', {
          ...this.value,
          order: this.value.order === 'asc' ? 'desc' : 'asc'
        });
      } else {
        this.$emit('input', {
          field: this.field,
          order: 'asc'
        });
      }
    }
  }
};
</script>

<style lang="scss">
.orderable-column {
  cursor: pointer;

  .order-asc,
  .order-desc {
    opacity: 0.3;
  }

  &.is-asc {
    .order-asc {
      opacity: 1;
    }
  }

  &.is-desc {
    .order-desc {
      opacity: 1;
    }
  }
}
</style>
