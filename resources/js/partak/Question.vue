<template>
    <div class="question">
        <div class="row">
            <div class="form-group col-md-4">
                <label :for="`q-${question.id}-type`">Type</label>
                <select
                    :id="`q-${question.id}-type`"
                    v-model="question.type"
                    class="form-control"
                >
                    <option value="text">Text input</option>
                    <option value="select">Options selection</option>
                    <option value="number">Number input</option>
                </select>
            </div>
            <div class="form-group col-md-8">
                <label :for="`q-${question.id}-label`">Label</label>
                <input
                    :id="`q-${question.id}-label`"
                    v-model="question.label"
                    class="form-control"
                    type="text"
                />
            </div>
        </div>

        <div class="form-group">
            <label :for="`q-${question.id}-description`">Description</label>
            <input
                :id="`q-${question.id}-description`"
                v-model="question.description"
                class="form-control"
                type="text"
            />
        </div>

        <div class="form-group form-check">
            <input
                :id="`q-${question.id}-required`"
                v-model="question.required"
                type="checkbox"
                class="form-check-input"
            />
            <label class="form-check-label" :for="`q-${question.id}-required`">Required</label>
        </div>

        <template v-if="question.type === 'select'">
            <div class="form-group form-check">
                <input
                    :id="`q-${question.id}-multiple`"
                    v-model="question.data.multi"
                    type="checkbox"
                    class="form-check-input"
                />
                <label
                    class="form-check-label"
                    :for="`q-${question.id}-multiple`"
                    >Allow multiple choices</label>
            </div>

            <div
                v-for="(option, index) in options"
                :key="option.value"
                class="option"
            >
                <input
                    v-model="option.label"
                    type="text"
                    class="form-control"
                />
                <button
                    type="button"
                    class="btn d-flex align-items-center"
                    @click="changeImage(option.value)"
                >
                    <span v-if="option.image" class="has-image mr-2 text-nowrap">Has image</span>
                    <span class="fas fa-image" />
                </button>
                <button
                    type="button"
                    class="btn"
                    :disabled="index === 0"
                    @click="moveOptionUp(option.value)"
                >
                    <span class="fas fa-arrow-up" />
                </button>
                <button
                    type="button"
                    class="btn"
                    :disabled="index === options.length - 1"
                    @click="moveOptionDown(option.value)"
                >
                    <span class="fas fa-arrow-down" />
                </button>
                <button
                    type="button"
                    class="btn"
                    @click="removeOption(option.value)"
                >
                    <span class="fas fa-trash-alt" />
                </button>
            </div>

            <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                @click="addOption"
            >
                <span class="fas fa-plus" /> Add option
            </button>
        </template>

        <div v-if="question.type === 'text'" class="form-group form-check">
            <input
                id="`q-${question.id}-multiline`"
                v-model="question.data.multi"
                type="checkbox"
                class="form-check-input"
            />
            <label class="form-check-label" :for="`q-${question.id}-multiline`">Multiline input</label>
        </div>

        <div class="question-actions">
            <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                @click="$emit('up', question)"
            >
                <span class="fas fa-arrow-up" /> Up
            </button>
            <button
                type="button"
                class="btn btn-outline-primary btn-sm"
                @click="$emit('down', question)"
            >
                <span class="fas fa-arrow-down" /> Down
            </button>
            <button
                type="button"
                class="btn btn-danger btn-sm"
                @click="$emit('remove', question)"
            >
                <span class="fas fa-trash-alt" /> Remove
            </button>
        </div>

        <image-picker
            :show="!!pickerOption"
            :image="pickerOption && pickerOption.image"
            base-path="/events"
            @cancel="pickerOption = null"
            @change="handleImageChange(pickerOption.value, $event)"
        />

        <input
            type="hidden"
            :name="`questions[${question.id}][type]`"
            :value="question.type"
        />
        <input
            type="hidden"
            :name="`questions[${question.id}][label]`"
            :value="question.label"
        />
        <input
            type="hidden"
            :name="`questions[${question.id}][description]`"
            :value="question.description"
        />
        <input
            type="hidden"
            :name="`questions[${question.id}][required]`"
            :value="question.required ? 1 : 0"
        />
        <input
            type="hidden"
            :name="`questions[${question.id}][data]`"
            :value="JSON.stringify(question.data)"
        />
    </div>
</template>

<script>
import ImagePicker from './ImagePicker';

export default {
    components: {
        ImagePicker
    },
    props: {
        question: Object
    },
    data() {
        return {
            options: [
                ...((this.question.data && this.question.data.options) || [])
            ],
            pickerOption: null
        };
    },
    watch: {
        options() {
            this.question.data = {
                ...this.question.data,
                options: this.options
            };
        }
    },
    methods: {
        addOption() {
            this.options.push({
                value:
                    (this.options.length > 0
                        ? Math.max(...this.options.map(o => o.value))
                        : 0) + 1,
                label: ''
            });
        },
        moveOptionUp(value) {
            const index = this.options.findIndex(o => o.value === value);
            if (index > 0) {
                const a = this.options[index - 1];
                this.options[index - 1] = this.options[index];
                this.options[index] = a;
            }
            this.options = [...this.options];
        },
        moveOptionDown(value) {
            const index = this.options.findIndex(o => o.value === value);
            if (index < this.options.length - 1) {
                const a = this.options[index + 1];
                this.options[index + 1] = this.options[index];
                this.options[index] = a;
            }
            this.options = [...this.options];
        },
        removeOption(value) {
            this.options = this.options.filter(o => o.value !== value);
        },
        changeImage(value) {
            this.pickerOption = this.options.find(o => o.value === value);
        },
        handleImageChange(value, file) {
            const option = this.options.find(o => o.value === value);
            if (option) {
                option.image = file;
                this.options = [...this.options];
            }
            this.pickerOption = null;
        }
    }
};
</script>

<style lang="scss" scoped>
.question {
    border-bottom: 1px solid #999;
    padding: 1rem 2rem;
}

.option {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
}

.question-actions {
    text-align: right;
}
</style>
