<template>
  <div class="questions-step">
    <form class="form" @submit.prevent="handleSubmit">
      <question
        v-for="question in questions"
        :ref="`question-${question.id_question}`"
        :key="question.id_question"
        v-model="customValues[question.id_question]"
        :question="question"
      />

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
      <cancel @click="$emit('cancel')" />
    </form>
  </div>
</template>

<script>
import Cancel from './Cancel';
import Question from './Question';

export default {
  components: {
    Cancel,
    Question
  },
  props: {
    user: {
      type: Object,
      required: true
    },
    showMedicalIssues: Boolean,
    showDiet: Boolean,
    questions: Array
  },
  data() {
    return {
      medicalIssues: this.user.medical_issues,
      foodPreference: this.user.diet,
      notes: null,
      customValues: this.questions.reduce((acc, q) => {
        acc[q.id_question] = null;
        return acc;
      }, {})
    };
  },
  methods: {
    handleSubmit() {
      const invalid = this.questions
        .map(q => this.$refs[`question-${q.id_question}`][0])
        .filter(q => !q.validate());

      if (invalid.length === 0) {
        this.$emit('submit', {
          medicalIssues: this.medicalIssues,
          foodPreference: this.foodPreference,
          notes: this.notes,
          custom: this.customValues
        });
      } else {
        document.documentElement.scrollTop =
          document.documentElement.scrollTop +
          invalid[0].$el.getBoundingClientRect().top -
          100;
      }
    }
  }
};
</script>

<style></style>
