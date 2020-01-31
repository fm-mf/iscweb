<template>
  <div>
    <transition name="fade">
      <div v-if="active" :class="{ loader: true, absolute, small }">
        <i class="fas fa-circle-notch fa-spin" />
      </div>
    </transition>
    <slot />
  </div>
</template>

<script>
export default {
  props: {
    small: { type: Boolean, required: false, default: false },
    active: { type: Boolean, required: false, default: true },
    absolute: { type: Boolean, required: false, default: false }
  }
};
</script>

<style lang="scss" scoped>
.loader {
  color: #aaa;
  font-size: 300%;
  margin: auto;
  padding: 1.5rem;
}

.absolute {
  position: absolute;
  height: 100%;
  min-height: 100px;
  width: 100%;
  text-align: center;
  background: rgba(255, 255, 255, 0.9);
  padding-top: 10%;
  z-index: 1;
}

.small {
  font-size: 150%;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}
</style>
