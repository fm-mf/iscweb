<template>
    <div :class="{ 'form-group': formGroup }">
        <button
            type="button"
            class="btn"
            :class="classes"
            data-toggle="modal"
            :data-target="target"
        >
            <slot></slot>
        </button>

        <protection-modal
            :id="modalId"
            :proceed-classes="proceedClasses"
            :modal-body-classes="modalBodyClasses"
        >
            <template #modal-title>
                {{ protectionTitle }}
            </template>
            <template #modal-btn-primary-text>
                {{ proceedText }}
            </template>
            <template #modal-btn-secondary-text>
                {{ cancelText }}
            </template>
            <template v-if="customModalBody" #modal-body>
                <slot name="modal-body"></slot>
            </template>
            <template v-else>
                {{ protectionText }}
            </template>
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
        proceedClasses: {
            type: String,
            default: 'btn-primary'
        },
        modalBodyClasses: {
            type: String,
            default: 'd-flex align-items-center'
        },
        modalId: {
            type: String,
            default: 'protectionModal'
        },
        customModalBody: {
            type: Boolean,
            default: false
        },
        formGroup: {
            type: Boolean,
            default: true
        }
    },
    computed: {
        target() {
            return `#${this.modalId}`;
        }
    }
};
</script>
