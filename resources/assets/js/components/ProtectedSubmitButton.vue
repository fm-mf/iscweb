<template>
  <div class="form-group">
    <button
      type="button"
      class="btn"
      :class="classes"
      data-toggle="modal"
      :data-target="target"
    >
      <slot></slot>
    </button>

    <protection-modal :id="modalId">
      <template v-slot:modal-title>
        {{ protectionTitle }}
      </template>
      <template v-slot:modal-btn-primary-text>
        {{ proceedText }}
      </template>
      <template v-slot:modal-btn-secondary-text>
        {{ cancelText }}
      </template>
      {{ protectionText }}
    </protection-modal>
  </div>
</template>

<script>
import ProtectionModal from './ProtectionModal';

export default {
  name: 'ProtectedFormSubmitButton',
  components: {
    ProtectionModal
  },
  props: {
    protectionTitle: {
      type: String,
      required: true
    },
    protectionText: {
      type: String,
      required: true
    },
    cancelText: {
      type: String,
      default: 'Cancel'
    },
    proceedText: {
      type: String,
      default: 'Continue'
    },
    classes: {
      type: String,
      default: 'btn-primary'
    },
    modalId: {
      type: String,
      default: 'protectionModal'
    }
  },
  computed: {
    target() {
      return `#${this.modalId}`;
    }
  }
};
</script>
