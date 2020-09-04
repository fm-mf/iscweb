<template>
  <div class="student-info">
    <div class="form-group">
      <h3>
        <span class="last-name">
          {{ student.last_name }},
        </span>
        {{ student.first_name }}
        ({{ student.id_user }})
      </h3>
      <small>{{ student.email }}</small>
    </div>
    <p v-if="error" class="alert-danger alert-block">
      {{ error }}
    </p>
    <div class="form-group">
      <label :for="phoneInputId">Phone</label>
      <input
        :id="phoneInputId"
        ref="phoneInput"
        v-model="phone"
        type="text"
        :name="phoneInputId"
        class="form-control"
        :class="{ 'is-invalid': phoneValidationError }"
        required="required"
        :minlength="phoneNumberLength"
        :maxlength="phoneNumberLength"
        pattern="420[0-9]{9}"
        @input="onPhoneInput"
      />
      <div v-if="phoneValidationError" class="invalid-feedback">
        {{ phoneValidationError }}
      </div>
    </div>
    <div class="form-group">
      <label :for="esnCardInputId">ESNcard number</label>
      <input
        :id="esnCardInputId"
        ref="esnCardInput"
        v-model="esnCardNumber"
        type="text"
        :name="esnCardInputId"
        class="form-control"
        :class="{'is-invalid': esnCardValidationError}"
        required="required"
        :minlength="esnCardNumberLength"
        :maxlength="esnCardNumberLength"
        @keyup.enter="save"
        @input="onEsnCardInput"
      />
      <div v-if="esnCardValidationError" class="invalid-feedback">
        {{ esnCardValidationError }}
      </div>
    </div>
    <div class="form-group text-right">
      <button
        type="button"
        class="btn btn-outline-secondary"
        @click="$emit('skip')"
      >
        <span class="fas fa-forward"></span> Skip
      </button>
      <button type="submit" class="btn btn-warning" @click="save">
        <span class="fas fa-save"></span> Save
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    student: {
      type: Object,
      required: true
    },
    url: {
      type: String,
      required: true
    },
    firstId: {
      type: Number,
      required: true
    },
    phoneNumberLength: {
      type: Number,
      default: 12
    },
    esnCardNumberLength: {
      type: Number,
      required: true
    }
  },

  data() {
    return {
      phone: null,
      esnCardNumber: null,
      error: null,
      phoneValidationError: null,
      esnCardValidationError: null
    };
  },

  computed: {
    phoneInputId() {
      return `phone-${this.student.id_user}`;
    },
    esnCardInputId() {
      return `esnCard-${this.student.id_user}`;
    },
    saveUrl() {
      return `${this.url}/${this.student.id_user}`;
    },
    phoneComplete() {
      return `+${this.phone}`;
    }
  },

  watch: {
    firstId(newValue) {
      if (newValue === this.student.id_user) {
        this.$refs.phoneInput.focus();
      }
    }
  },

  mounted() {
    if (this.firstId === this.student.id_user) {
      this.$refs.phoneInput.focus();
    }
  },

  methods: {
    save() {
      if (!this.esnCardNumber || !this.phone) {
        return;
      }

      axios.patch(this.saveUrl, {
        phone: this.phoneComplete,
        esn_card_number: this.esnCardNumber
      })
      .then(response => {
        this.$emit('saved');
      })
      .catch(error => {
        if (error.response.status === 422) {
          this.onValidationErrors(error.response.data.errors);
        } else {
          this.error = error.message;
          console.error(error);
        }
      });
    },
    onValidationErrors(errors) {
      if (errors.hasOwnProperty('esn_card_number')) {
        this.esnCardValidationError = errors.esn_card_number[0];
        this.$refs.esnCardInput.focus();
        this.$refs.esnCardInput.select();
      } else {
        this.esnCardValidationError = null;
      }
      if (errors.hasOwnProperty('phone')) {
        this.phoneValidationError = errors.phone[0];
        this.$refs.phoneInput.focus();
        this.$refs.phoneInput.select();
      } else {
        this.phoneValidationError = null;
      }
    },
    onPhoneInput(event) {
      this.phoneValidationError = null;
      if (event.target.value.length === this.phoneNumberLength) {
        this.$refs.esnCardInput.focus();
        this.$refs.esnCardInput.select();
      }
    },
    onEsnCardInput(event) {
      this.esnCardValidationError = null;
      if (event.target.value.length === this.esnCardNumberLength) {
        this.save();
      }
    }
  }
};
</script>

<style>
.student-info h3 {
  margin-bottom: 0;
}

.student-info h3 .last-name {
  text-transform: uppercase;
}
</style>
