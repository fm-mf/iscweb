<template>
    <div class="auth-error">
        <div v-if="!!error" class="auth-error-body">
            <div class="icon">
                <i class="fas fa-exclamation-circle" />
            </div>
            <div class="text">
                <div v-for="(item, index) in displayError" :key="index">
                    {{ item }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        error: {
            type: [String, Array],
            default: null
        }
    },
    computed: {
        displayError() {
            return Array.isArray(this.error) ? this.error : [this.error];
        }
    }
};
</script>

<style></style>
