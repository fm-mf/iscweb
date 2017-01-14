<template>
        <multiselect v-model="value" :options="options"></multiselect>
</template>

<script>

    export default {
        // OR register locally
        data () {
            return {
                value: null,
                options: ['list', 'of', 'options']
            }
        }
    }
</script>