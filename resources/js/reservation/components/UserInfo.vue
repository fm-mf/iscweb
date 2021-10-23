<template>
    <div class="user-data">
        <i class="fas fa-user-circle" />
        <div class="user-name">{{ user.first_name }} {{ user.last_name }}</div>
        <div class="button change" @click="$emit('logout')">
            <i class="fas fa-times" />
        </div>
    </div>
</template>

<script>
export default {
    props: {
        user: {
            type: Object,
            required: true
        }
    }
};
</script>

<style></style>
