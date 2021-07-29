<template>
  <div v-if="isActive" class="tab"><slot /></div>
</template>

<script>
export default {
  props: {
    id: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    selected: Boolean
  },
  data: () => ({
    isActive: false
  }),
  mounted() {
    this.isActive = this.selected;
  }
};
</script>

<style></style>
