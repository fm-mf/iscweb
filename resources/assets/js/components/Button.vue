<template>
    <span>
        <a :href="url" role="button" class="btn btn-xs" :class="buttonStyle" @click="onClick">
            <slot></slot>
        </a>
        <modal v-if="showModal" @submit="onSubmit" @cancel="showModal = false" :show="showModal">
            <div slot="body">
                {{ protectionText }}
            </div>
        </modal>
    </span>
</template>

<script>
    import Modal from './Modal.vue'

    export default {

        props: {
            url: {
                type: String
            },
            protectionText: {
                type: String
            },
            buttonStyle: {
                type: String,
                default: ""
            }
        },

        components: {
            Modal
        },

        data () {
            return {
                showModal: false
            }
        },

        computed: {
        },

        methods: {
            onClick(event) {
                event.preventDefault();
                this.showModal = true;
            },

            onSubmit() {
                window.location.href = this.url;
            }


        }
    };
</script>