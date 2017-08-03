<template>
    <div class="input-group">
        <span class="input-group-addon" id="url"><span class="glyphicon glyphicon-link"></span> </span>
        <input type="text" id="unique_url" class="form-control" :value="url" aria-describedby="url" readonly="">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button" @click="copy" data-toggle="tooltip" data-placement="right" v-bind:title="buttonTitle"><span class="glyphicon glyphicon-copy"></span> </button>
        </span>
    </div><!-- /input-group -->
</template>
<script>
    export default {

        props: {
            url: {
                type: String
            },

        },

        data () {
            return {
                buttonTitle: 'fkdfjdkf',
                show: false,
            }
        },

        computed: {
        },

        methods: {
            copy(event) {
                var url = document.getElementById('unique_url');
                url.select();
                var suc = document.execCommand('copy');
                this.buttonTitle = 'Copied!';
                //show = true;

            },

        },
        mounted() {
            this.$nextTick(() => {
                $('[data-toggle="tooltip"]').tooltip()
            });
        }

    };
</script>