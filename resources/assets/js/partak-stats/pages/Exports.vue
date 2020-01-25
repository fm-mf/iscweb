<template>
  <div>
    <card
      icon="fas fa-file-excel"
      title="Export CE candidates"
      description="Exchange students who expressed interest in representing their country on Culture Evening (when filling out their profile)"
      :href="
        `/partak/stats/export/semester/${semester}/culture-evening-candidates`
      "
    />

    <card
      icon="fas fa-file-excel"
      title="Export active buddies"
      description="Export list of buddies who logged into buddy database in last 4 months"
      :href="`/partak/stats/export/active-buddies?months=${months}`"
    />
  </div>
</template>

<script>
import Card from '../components/Card';

export default {
  components: {
    Card
  },
  props: {
    semester: { type: String, required: true }
  },
  data() {
    const monthsOptions = [];
    for (let i = 1; i <= 12; i++) {
      monthsOptions.push(i);
    }

    return {
      months: 4,
      monthsOptions
    };
  }
};
</script>

<style></style>
