<template>
    <div class="tabs">
        <div class="tab-header">
            <div
                v-for="tab in tabs"
                :key="tab.id"
                :class="['tab', { selected: tab.isActive }]"
                @click="select(tab.id)"
            >
                {{ tab.title }}
            </div>
        </div>

        <div class="tab-body">
            <slot />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        defaultId: String
    },
    data() {
        return {
            tabs: []
        };
    },
    created() {
        this.tabs = this.$children;
    },
    mounted() {
        if (this.$props.defaultId) {
            this.select(this.$props.defaultId);
        }
    },
    methods: {
        select(id) {
            this.tabs.forEach(tab => {
                tab.isActive = tab.id === id;
            });
            this.$emit('change', id);
        }
    }
};
</script>

<style></style>
