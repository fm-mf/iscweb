<template>
  <div class="buddies">
    <table class="b-table">
      <tr v-for="(buddy, index) in buddies" :key="index">
        <td>
          <a :href="`/partak/users/buddies/${buddy.id_user}`">{{
            `${buddy.last_name}, ${buddy.first_name}`
          }}</a>
        </td>
        <td>{{ buddy.exchange_students_count }}</td>
      </tr>
    </table>
  </div>
</template>

<script>
import { getBuddies, cached } from '../api';

export default {
  props: { semester: { type: String, required: true } },
  data: () => ({
    buddies: null
  }),
  created() {
    this.load();
  },
  methods: {
    load() {
      cached(getBuddies(this.semester)).then(buddies => {
        this.buddies = buddies;
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.b-table {
  td {
    padding: 0.1rem 0.5rem;
  }
}
</style>
