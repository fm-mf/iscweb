<template>
    <div>
        <div
            class="btn btn-outline-secondary barcode-button"
            title="Barcode scanner"
            @click="shown = true"
        >
            <i class="fas fa-barcode"></i>
        </div>

        <barcode-reader v-if="shown" @code="handleCode" @close="handleClose" />
    </div>
</template>

<script>
import BarcodeReader from './BarcodeReader';

export default {
    components: {
        BarcodeReader
    },
    data: () => ({
        shown: false
    }),
    methods: {
        handleCode(code) {
            this.$emit('code', code);
            this.shown = false;
        },
        handleClose() {
            this.shown = false;
        }
    }
};
</script>

<style scoped lang="scss">
.barcode-button {
    border-right: 0;

    .fas {
        margin-right: 0;
    }
}
</style>
