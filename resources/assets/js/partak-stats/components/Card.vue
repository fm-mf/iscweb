<template>
  <a class="card" :href="href" target="_blank" @click="$emit('click')">
    <div class="c-title">
      {{ title }}
    </div>
    <div v-if="description" class="c-description">
      {{ description }}
    </div>
    <div v-if="icon" class="c-icon">
      <i :class="icon" />
    </div>
  </a>
</template>

<script>
export default {
  props: {
    title: { type: String, required: true },
    description: { type: String, required: false, default: null },
    icon: { type: String, required: false, default: null },
    href: { type: String, required: false, default: undefined }
  }
};
</script>

<style lang="scss" scoped>
.card {
  float: left;
  display: block;
  width: 300px;
  height: 250px;
  background: #0079c1;
  padding: 1rem;
  position: relative;
  color: #fff;
  margin: 1rem;
  cursor: pointer;

  &:hover,
  &:focus {
    text-decoration: none;
    background: lighten(#0079c1, 5%);
  }

  .c-title {
    font-size: 150%;
  }

  .c-description {
    margin-top: 0.5rem;
  }

  .c-icon {
    position: absolute;
    bottom: 0.5rem;
    right: 1rem;
    font-size: 200%;
  }
}
</style>
