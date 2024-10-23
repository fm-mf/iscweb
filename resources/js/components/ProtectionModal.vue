<template>
    <div
        :id="id"
        class="modal fade"
        tabindex="-1"
        role="dialog"
        :aria-labelledby="titleId"
        aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 :id="titleId" class="modal-title">
                        <slot name="modal-title"></slot>
                    </h5>
                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal"
                        aria-label="Close"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" :class="modalBodyClasses">
                    <slot name="modal-body">
                        <img
                            src="/img/partak/speedy.jpg"
                            class="rounded-circle"
                            alt="Warning image"
                        />
                        <p class="ml-3 mb-0">
                            <slot></slot>
                        </p>
                    </slot>
                </div>
                <div class="modal-footer">
                    <slot name="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            <slot name="modal-btn-secondary-text">
                                Cancel
                            </slot>
                        </button>
                        <button
                            type="submit"
                            class="btn"
                            :class="proceedClasses"
                        >
                            <slot name="modal-btn-primary-text">
                                Continue
                            </slot>
                        </button>
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProtectionModal',
    props: {
        id: String,
        proceedClasses: {
            type: String,
            required: true
        },
        modalBodyClasses: {
            type: String,
            required: true
        }
    },
    computed: {
        titleId() {
            return `${this.id}Title`;
        }
    }
};
</script>

<style scoped>
.modal-body img {
    width: 6rem;
}

.modal-title {
    margin-top: 0;
}
</style>
