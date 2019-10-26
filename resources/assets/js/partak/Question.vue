<template>
  <div class="question">
    <div class="row">
      <div class="form-group col-md-4">
        <label>Type</label>
        <select v-model="question.type" class="form-control">
          <option value="text">Text input</option>
          <option value="select">Options selection</option>
          <option value="number">Number input</option>
        </select>
      </div>
      <div class="form-group col-md-8">
        <label>Label</label>
        <input v-model="question.label" class="form-control" type="text" />
      </div>
    </div>

    <div class="form-group">
      <label>Description</label>
      <input v-model="question.description" class="form-control" type="text" />
    </div>

    <label>
      <input v-model="question.required" type="checkbox" />
      Required
    </label>

    <div v-if="question.type === 'select'">
      <label>
        <input v-model="question.data.multi" type="checkbox" />
        Allow multiple choices
      </label>

      <div
        v-for="(option, index) in options"
        :key="option.value"
        class="option"
      >
        <input v-model="option.label" type="text" class="form-control" />
        <div
          :class="{ action: true, disabled: index === 0 }"
          @click="moveOptionUp(option.value)"
        >
          <span class="glyphicon glyphicon-arrow-up" />
        </div>
        <div
          :class="{ action: true, disabled: index === options.length - 1 }"
          @click="moveOptionDown(option.value)"
        >
          <span class="glyphicon glyphicon-arrow-down" />
        </div>
        <div class="action" @click="removeOption(option.value)">
          <span class="glyphicon glyphicon-remove-sign" />
        </div>
      </div>

      <div class="btn btn-default btn-sm" @click="addOption">
        <span class="glyphicon glyphicon-plus" /> Add option
      </div>
    </div>

    <div v-if="question.type === 'text'">
      <label>
        <input v-model="question.data.multi" type="checkbox" />
        Multiline input
      </label>
    </div>

    <div class="question-actions">
      <div class="btn btn-default btn-sm" @click="$emit('up', question)">
        <span class="glyphicon glyphicon-arrow-up" /> Up
      </div>
      <div class="btn btn-default btn-sm" @click="$emit('down', question)">
        <span class="glyphicon glyphicon-arrow-down" /> Down
      </div>
      <div class="btn btn-danger btn-sm" @click="$emit('remove', question)">
        <span class="glyphicon glyphicon-remove-sign" /> Remove
      </div>
    </div>

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
export default {
  props: {
    question: Object
  },
  data() {
    return {
      options: [...((this.question.data && this.question.data.options) || [])]
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

  input[type='text'] {
    height: 24px;
  }

  .action {
    padding: 0 0.5rem;
    cursor: pointer;

    &.disabled {
      opacity: 0.1;
      cursor: inherit;
    }
  }
}

.question-actions {
  text-align: right;
}
</style>
