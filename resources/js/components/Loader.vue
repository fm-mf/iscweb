<template>
    <div v-show="!loaded" :class="['loader', { fill: fill }]">
        <i class="fas fa-circle-notch fa-spin" />
    </div>
</template>

<script>
export default {
    props: {
        loaded: Boolean,
        fill: Boolean
    }
};
</script>

<style lang="scss">
.loader {
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.8);
    box-sizing: border-box;
    padding: 5em 0;
    text-align: center;
    z-index: 1;

    &.fill {
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    &-container {
        position: relative;
    }

    > i {
        font-size: 50px;
        color: #eee;
    }
}
</style>
