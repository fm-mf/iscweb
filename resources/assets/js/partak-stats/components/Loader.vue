<template>
  <div v-if="active" class="loader">
    <i class="fas fa-circle-notch fa-spin" />
  </div>
</template>

<script>
export default {
  props: {
    small: { type: Boolean, required: false, default: false },
    active: { type: Boolean, required: false, default: true }
  }
};
</script>

<style></style>
