<template>
    <div class="form-group drop-down">
        <label v-if="title" :for="randomId">{{ title }}</label>
        <multiselect
                :options="options"
                :searchable="searchable"
                :allow-empty="allowEmpty"
                :track-by="trackBy"
                :label="label"
                placeholder="Select..."
                :show-labels="true"
                :id="randomId"
                v-model="currentValue"
                :multiple="multiple"
                v-on:input="onInput"
        ></multiselect>
        <input type="hidden" :name="formName" :value="myvalues">
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        components: { Multiselect },

        props: {
            options: {
                type: Array,
                default: function() {
                    return [];
                }
            },
            value: {
                default: null
            },
            placeholder: {
                type: String,
                default: 'Select...'
            },
            searchable: {
                type: Boolean,
                default: true
            },
            allowEmpty: {
                type: Boolean,
                default: true
            },
            trackBy: {
                type: String,
                default: 'id'
            },
            label: {
                type: String,
                default: 'name'
            },
            title: {
                type: String,
                default: null
            },
            formName: {
                type: String,
                default: 'roles'
            },

            multiple: {
                default: false
            }
        },

        data () {
            return {
                currentValue: this.value
            }
        },

        computed: {
            myvalues: function() {
                if (!this.value) {
                    return "";
                }
                var v = [];
                for (var i = 0; i < this.currentValue.length; ++i) {
                    var track = this.trackBy;
                    v.push(this.currentValue[i][track]);
                }
                return v;
            }
        },

        methods: {
            onInput(event) {
                this.$emit('input', event);
            }
        }
    };
</script>