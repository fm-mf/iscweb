<template>
  <div>
    <nav class="navbar navbar-expand-lg subnav">
      <div style="width: 130px"></div>
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">
            Dashboard
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/arrivals" class="nav-link">
            Arrivals
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/buddies" class="nav-link">
            Buddies
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/students" class="nav-link">
            Students
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/history" class="nav-link">
            History
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/exports" class="nav-link">
            Exports
          </router-link>
        </li>
      </ul>
    </nav>

    <div class="stats-content container">
      <div class="stats-filter">
        <select v-if="semesters.data" v-model="semester" class="form-control">
          <option
            v-for="item in semesters.data"
            :key="item.id"
            :value="item.id"
          >
            {{ item.name }}
          </option>
        </select>
      </div>

      <div v-if="error" class="error">
        <p>{{ error.message }}</p>
        <div v-if="error.error" class="error-desc">
          <div><strong>URL:</strong> {{ error.error.request.responseURL }}</div>
          <div><strong>Error:</strong> {{ error.error.response.status }}</div>
        </div>
        <div class="btn btn-warning" @click="error = null">
          OK
        </div>
      </div>
      <router-view :semester="semester" />
    </div>
  </div>
</template>

<script>
import {
  cached,
  getSemesters,
  promised,
  addErrorListener,
  removeErrorListener
} from './api';

export default {
  props: {
    currentSemester: { type: String, required: true }
  },
  data() {
    return {
      semester: this.currentSemester,
      semesters: promised(cached(getSemesters())),
      error: null
    };
  },
  created() {
    addErrorListener(this.catchError);
  },
  destroyed() {
    removeErrorListener(this.catchError);
  },
  methods: {
    catchError(e) {
      if (e.response && e.response.status === 401) {
        window.location.reload();
      } else {
        this.error = {
          message: `There was an error when loading data from server.`,
          error: e
        };
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.stats-content {
  padding: 1rem 3rem;
  position: relative;
}

.stats-filter {
  margin-bottom: 2rem;
}

.error {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding: 1rem 3rem;
  background: rgba(255, 50, 50, 0.9);
  color: #fff;
  z-index: 2;
}

.error-desc {
  margin: 1rem;
}
</style>
