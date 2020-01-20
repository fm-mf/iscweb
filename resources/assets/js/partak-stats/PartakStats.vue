<template>
  <div class="container-fluid">
    <div class="row match-my-cols">
      <div class="col-sm-3 submenu matched-cols">
        <router-link to="/">
          Dashboard
        </router-link>
        <router-link to="/arrivals">
          Arrivals
        </router-link>
        <router-link to="/buddies">
          Buddies
        </router-link>
      </div>
      <div class="col-sm-9 no-padding matched-cols">
        <div class="stats-content">
          <router-view :semester="currentSemester" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    currentSemester: { type: String, required: true }
  }
};
</script>

<style></style>
