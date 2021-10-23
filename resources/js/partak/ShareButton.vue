<template>
    <span>
        <a
            :href="url"
            role="button"
            :class="buttonStyle || 'btn'"
            @click="onClick"
        >
            <slot></slot>
        </a>
        <modal
            v-if="showModal"
            :show="showModal"
            @submit="showModal = false"
            @cancel="showModal = false"
        >
            <div slot="header">
                Shareable link
            </div>
            <div slot="content">
                <unique-url style="max-width: 400px" :url="url"></unique-url>
            </div>
            <div slot="footer">
                <button class="btn btn-secondary" @click="showModal = false">
                    Close
                </button>
            </div>
        </modal>
    </span>
</template>

<script>
import Modal from '../components/Modal';

export default {
    components: {
        Modal
    },
    props: {
        url: String,
        buttonStyle: String
    },
    data: () => ({
        showModal: false
    }),
    methods: {
        onClick(e) {
            e.preventDefault();

            this.showModal = true;
        }
    }
};
</script>

<style></style>
