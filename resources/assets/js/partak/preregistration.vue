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
            Preregistration will be automatically removed after X days
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
      </fieldset>
    </div>
  </div>
</template>

<script>
export default {
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
      medical: this.pMedical
    };
  }
};
</script>

<style></style>
