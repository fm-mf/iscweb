<template>
  <div>
    <div class="form-group form-check">
      <input
        id="reservations_enabled"
        v-model="enabled"
        name="reservations_enabled"
        type="checkbox"
        value="1"
        class="form-check-input"
      />
      <label for="reservations_enabled" class="form-check-label">
        Enable reservations
      </label>
    </div>

    <fieldset v-show="enabled">
      <legend>Reservations</legend>
      <div class="form-group">
        <label
          for="reservations_removal_limit"
          class="required"
        >
          Reservation expires after (days)
        </label>
        <input
          id="reservations_removal_limit"
          v-model="expiration"
          required="required"
          name="reservations_removal_limit"
          type="number"
          class="form-control"
          min="1"
        />
        <div class="form-text text-muted ml-3">
          Reservations will be automatically cancelled after X days.
        </div>
      </div>
      <div class="form-group form-check">
        <input
          id="reservations_medical"
          v-model="medical"
          name="reservations_medical"
          type="checkbox"
          value="1"
          class="form-check-input"
        />
        <label for="reservations_medical" class="form-check-label">
          Show medical issues
        </label>
      </div>
      <div class="form-group form-check">
        <input
          id="reservations_diet"
          v-model="diet"
          name="reservations_diet"
          type="checkbox"
          value="1"
          class="form-check-input"
        />
        <label for="reservations_diet" class="form-check-label">
          Show diet
        </label>
      </div>

     <questions :list="questions" />
    </fieldset>
  </div>
</template>

<script>
/* global jsoptions:readonly */
import Questions from './Questions';

const maybeParse = data => {
  try {
    return JSON.parse(data);
  } catch (e) {
    return undefined;
  }
};

export default {
  components: {
    Questions
  },
  props: {
    pEnabled: Boolean,
    pExpiration: { type: Number, required: true },
    pDiet: Boolean,
    pMedical: Boolean
  },
  data() {
    return {
      enabled: this.pEnabled,
      expiration: this.pExpiration,
      diet: this.pDiet,
      medical: this.pMedical,
      questions: jsoptions.questions.map(q => ({
        ...q,
        id: q.id_question,
        data: maybeParse(q.data) || {}
      }))
    };
  }
};
</script>

<style></style>
