<template>
    <div
        :class="{
            question: true,
            'form-group': true,
            required: question.required,
            invalid: errors.length > 0
        }"
    >
        <label>{{ question.label }}</label>
        <div class="description">{{ question.description }}</div>
        <div v-for="(error, index) in errors" :key="index" class="error">
            {{ error }}
        </div>
        <input
            v-if="
                (question.type === 'text' && !data.multi) ||
                    question.type === 'number'
            "
            :type="question.type"
            :value="value"
            :required="question.required !== 0"
            @input="handleInput"
        />
        <textarea
            v-if="question.type === 'text' && data.multi"
            :value="value"
            :required="question.required !== 0"
            @input="handleInput"
        >
        </textarea>
        <div v-if="question.type === 'select'">
            <div
                v-for="option in data.options"
                :key="option.value"
                :class="{
                    option: true,
                    selected: isSelected(option),
                    multi: !!data.multi,
                    'has-image': !!option.image
                }"
                @click="toggleSelected(option)"
            >
                <div v-if="option.image" class="image">
                    <img :src="`/events/${option.image}`" :alt="option.label" />
                </div>
                <div class="selector"><div class="inner" /></div>
                <div class="label">{{ option.label }}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        question: Object,
        value: [String, Array, Number, Object, Boolean]
    },
    data() {
        return {
            data: this.question.data ? JSON.parse(this.question.data) : {},
            errors: []
        };
    },
    computed: {
        selectedValues() {
            return Array.isArray(this.value) ? this.value : [];
        }
    },
    watch: {
        value() {
            this.validate();
        }
    },
    methods: {
        handleInput(e) {
            this.$emit('input', e.target.value);
        },
        isSelected(option) {
            return this.data.multi
                ? this.selectedValues.includes(option.value)
                : option.value === this.value;
        },
        toggleSelected(option) {
            if (this.data.multi) {
                if (this.selectedValues.includes(option.value)) {
                    this.$emit(
                        'input',
                        this.selectedValues.filter(s => s !== option.value)
                    );
                } else {
                    this.$emit('input', [...this.selectedValues, option.value]);
                }
            } else {
                this.$emit('input', option.value);
            }
        },
        validate() {
            const errors = [];

            if (this.required && !this.isFilled()) {
                errors.push('Please answer this question');
            }

            this.errors = errors;

            return errors.length === 0;
        },
        isFilled() {
            switch (this.question.type) {
                case 'text': {
                    return (
                        this.value && this.value.replace(/\s/g, '').length > 0
                    );
                }
                case 'number': {
                    return (
                        this.value !== undefined &&
                        this.value !== null &&
                        this.value.length > 0
                    );
                }
                case 'select': {
                    return (
                        this.value !== null &&
                        this.value !== undefined &&
                        (!this.data.multi || this.value.length > 0)
                    );
                }
                default: {
                    return !!this.value;
                }
            }
        }
    }
};
</script>

<style lang="scss" scoped>
.description {
    color: #999;
    margin-bottom: 0.5rem;
    font-size: 85%;
}

.error {
    color: #990000;
}

.question {
    padding-right: 10px;

    &.required label::after {
        content: '*';
        color: #990000;
    }

    &.invalid {
        border-right: 4px solid #990000;
        padding-right: 6px;
    }
}

.option {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    margin: 0.5rem 0;
    cursor: pointer;

    &.has-image {
        margin-bottom: 1rem;
    }

    .selector {
        width: 1rem;
        height: 1rem;
        margin-right: 0.5rem;
        border-radius: 50%;
        background: #eee;
        box-sizing: border-box;

        .inner {
            margin: 0.2rem;
            width: 0.6rem;
            height: 0.6rem;
            border-radius: 50%;
        }
    }

    .image {
        width: 100%;
        margin: 0.5rem 0;
        display: flex;

        > img {
            max-width: 100%;
            box-shadow: 1px 1px 1px 0 rgba(0, 0, 0, 0.14),
                0 2px 1px -1px rgba(0, 0, 0, 0.12),
                0 1px 3px 0 rgba(0, 0, 0, 0.2);
        }
    }

    &.multi {
        .selector {
            border-radius: 0;

            .inner {
                border-radius: 0;
            }
        }

        &.selected {
            .selector {
                background: #eee;

                .inner {
                    background: #0f87e2;
                }
            }
        }
    }

    &.selected {
        color: #095288;

        .selector {
            .inner {
                background: #0f87e2;
            }
        }

        .image > img {
            box-shadow: 0 0 0 2px #0f87e2;
        }
    }
}
</style>
