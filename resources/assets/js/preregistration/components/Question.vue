<template>
  <div class="form-group">
    <label>{{ question.label }}</label>
    <div class="description">{{ question.description }}</div>
    <input
      v-if="
        (question.type === 'text' && !data.multi) || question.type === 'number'
      "
      :type="question.type"
      :value="value"
      @input="handleInput"
    />
    <textarea
      v-if="question.type === 'text' && data.multi"
      :value="value"
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
          multi: !!data.multi
        }"
        @click="toggleSelected(option)"
      >
        <div v-if="option.image" class="image">
          <img :src="option.image" :alt="option.label" />
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
    value: [String, Array, Object, Boolean]
  },
  data() {
    return {
      data: this.question.data ? JSON.parse(this.question.data) : {}
    };
  },
  computed: {
    selectedValues() {
      return Array.isArray(this.value) ? this.value : [];
    }
  },
  methods: {
    handleInput(e) {
      this.$emit('input', e.target.value);
    },
    isSelected(option) {
      return this.data.multi
        ? this.selectedValues.includes(option.value)
        : option.value === this.selected;
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

.option {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  margin: 0.5rem 0;
  cursor: pointer;

  .selector {
    width: 1rem;
    height: 1rem;
    margin-right: 0.5rem;
    border-radius: 50%;
    background: #eee;
    box-sizing: border-box;
  }

  .image {
    box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.14),
      0 2px 1px -1px rgba(0, 0, 0, 0.12), 0 1px 3px 0 rgba(0, 0, 0, 0.2);
    margin: 1rem 0 0.5rem 0;
    display: flex;

    > img {
      max-width: 100%;
    }
  }

  &.multi {
    .selector {
      border-radius: 0;

      .inner {
        margin: 0.2rem;
        width: 0.6rem;
        height: 0.6rem;
      }
    }

    &.selected {
      .selector {
        background: #eee;

        .inner {
          background: #0f87e2;
        }
      }

      .image {
        box-shadow: 0 0 0 2px #0f87e2;
      }
    }
  }

  &.selected {
    .selector {
      background: #0f87e2;
    }
  }
}
</style>
