<template>
    <div class="stat">
        <div class="s-label">
            {{ label }}
        </div>
        <div :class="{ 's-value': true, loading: value === null }">
            {{ value === null ? '...' : value }}
        </div>
        <div v-if="note" class="s-note">
            {{ note }}
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: { type: String, required: true },
        value: { type: [String, Number], required: false, default: null },
        note: { type: String, required: false, default: null }
    }
};
</script>

<style lang="scss" scoped>
.stat {
    float: left;
    width: 30%;
    min-width: 150px;
    padding: 0.5rem 2rem;
    border-left: 4px solid #eee;
    margin-right: 1rem;

    .s-label {
        font-size: 100%;
    }

    .s-value {
        font-size: 200%;
    }

    .s-note {
        font-size: 75%;
        color: #999;
    }
}

.loading {
    background: #ddd;
    color: #ddd;

    animation-name: loading;
    animation-duration: 400ms;
    animation-iteration-count: infinite;
}

@keyframes loading {
    0% {
        opacity: 0.5;
    }
    50% {
        opacity: 0.75;
    }
    100% {
        opacity: 0.5;
    }
}
</style>
