<template>
  <div>
    <div class="form-group">
      <input
        id="preregistration"
        v-model="enabled"
        name="preregistration"
        type="checkbox"
        value="1"
      />
      <label for="preregistration" class="control-label">
        Preregistrations
      </label>

      <fieldset v-show="enabled">
        <legend>Preregistration</legend>
        <div class="form-group">
          <label
            for="preregistration_removal_limit"
            class="control-label required"
          >
            Reservation expires after (days)
          </label>
          <input
            id="preregistration_removal_limit"
            v-model="expiration"
            required="required"
            name="preregistration_removal_limit"
            type="text"
            class="form-control"
          />
          <div class="info">
            Preregistration will be automatically cancelled after X days
          </div>
        </div>
        <div class="form-group">
          <input
            id="preregistration_medical"
            v-model="medical"
            name="preregistration_medical"
            type="checkbox"
            value="1"
          />
          <label for="preregistration_medical" class="control-label">
            Show medical issues
          </label>
        </div>
        <div class="form-group">
          <input
            id="preregistration_diet"
            v-model="diet"
            name="preregistration_diet"
            type="checkbox"
            value="1"
          />
          <label for="preregistration_diet" class="control-label">
            Show diet
          </label>
        </div>

        <questions :list="questions" />
      </fieldset>
    </div>
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
