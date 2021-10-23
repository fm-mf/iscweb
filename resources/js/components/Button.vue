<template>
    <span>
        <a
            :href="url"
            role="button"
            class="btn"
            :class="buttonStyle"
            @click="onClick"
        >
            <slot></slot>
        </a>
        <modal
            v-if="showModal"
            :show="showModal"
            @submit="onSubmit"
            @cancel="showModal = false"
        >
            <div slot="body">
                {{ protectionText }}
            </div>
        </modal>
    </span>
</template>

<script>
import Modal from './Modal.vue';

export default {
    components: {
        Modal
    },

    props: {
        url: {
            type: String
        },
        protectionText: {
            type: String
        },
        buttonStyle: {
            type: String,
            default: ''
        },
        ids: {
            type: String,
            default: ''
        }
    },

    data() {
        return {
            showModal: false,
            urlAddition: ''
        };
    },

    computed: {},

    methods: {
        onClick(event) {
            event.preventDefault();
            if (this.ids.length > 0) {
                var split = this.ids.split(' ');
                this.urlAddition = '';
                var addition = '';
                split.forEach(function(name) {
                    addition += '/' + document.getElementsByName(name)[0].value;
                });
                this.urlAddition = addition;
            }
            this.showModal = true;
        },

        onSubmit() {
            window.location.href = this.url + this.urlAddition;
        }
    }
};
</script>
