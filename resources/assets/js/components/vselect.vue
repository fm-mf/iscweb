<template>
    <div>
        <vue-select name="select1" :options="options1"></vue-select>
    </div>
</template>

<script>
    export default {
        components: {
            "vue-select": require("vue-select")
        },

        data() {
            return {
                selected: null,
                options1: ['foo','bar','baz']
            }
        }
    }
</script>