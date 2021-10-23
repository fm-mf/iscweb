<template>
    <div class="article">
        <a class="title" :href="link">{{ title }}</a>
        <div class="description">{{ description }}</div>
    </div>
</template>

<script>
export default {
    props: {
        title: String,
        link: String,
        description: String
    }
};
</script>

<style lang="scss">
.article {
    margin-bottom: 1rem;

    .title {
        font-size: 125%;
    }
}
</style>
