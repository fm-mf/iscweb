<template>
  <div class="questions-step">
    <form class="form" @submit.prevent="handleSubmit">
      <div v-if="showDiet" class="form-group">
        <label>Food preference</label>
        <select v-model="foodPreference">
          <option :value="null">
            No preference
          </option>
          <option value="Vegetarian">
            Vegetarian
          </option>
          <option value="Vegan">
            Vegan
          </option>
          <option value="Fish Only">
            Fish only
          </option>
        </select>
      </div>

      <div v-if="showMedicalIssues" class="form-group">
        <label>Medical issues</label>
        <textarea v-model="medicalIssues" />
      </div>

      <div class="form-group">
        <label>Notes to organizers</label>
        <textarea v-model="notes" />
      </div>

      <button><i class="fas fa-check" /> Confirm registration</button>
    </form>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true
    },
    showMedicalIssues: Boolean,
    showDiet: Boolean
  },
  data() {
    return {
      medicalIssues: this.user.medical_issues,
      foodPreference: this.user.diet,
      notes: null
    };
  },
  methods: {
    handleSubmit() {
      this.$emit('submit', {
        medicalIssues: this.medicalIssues,
        foodPreference: this.foodPreference,
        notes: this.notes
      });
    }
  }
};
</script>

<style></style>
