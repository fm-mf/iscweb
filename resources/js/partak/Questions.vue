<template>
  <div>
    <button type="button" class="btn btn-outline-primary" @click="show = !show">
      <span class="fas fa-edit"></span>
      Edit custom questions
    </button>

    <div :class="{ 'p-modal': true, show }">
      <div class="p-content">
        <div class="p-title">Custom questions</div>

        <div class="p-body">
          <question
            v-for="question in questions"
            :key="question.id"
            :question="question"
            @up="moveUp(question)"
            @down="moveDown(question)"
            @remove="remove(question)"
          />

          <div v-if="questions.length === 0" class="no-data">
            No custom questions
          </div>
        </div>

        <div class="p-actions">
          <button type="button" class="btn btn-outline-primary" @click="add">
            <span class="fas fa-plus" /> Add question
          </button>
          <button type="button" class="btn btn-primary" @click="show = !show">
            <span class="fas fa-check" /> Done
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Question from './Question';

export default {
  components: { Question },
  props: {
    list: Array
  },
  data() {
    return {
      show: false,
      questions: this.list
    };
  },
  methods: {
    add() {
      this.questions.push({
        id: `new-${(this.questions.length > 0
          ? Math.max(
              ...this.questions.map(q =>
                q.id.toString().match(/^new-*/)
                  ? parseInt(q.id.substr(4), 10)
                  : q.id
              )
            )
          : 0) + 1}`,
        label: `Question ${this.questions.length + 1}`,
        description: null,
        required: false,
        type: 'text',
        data: {}
      });
    },
    moveUp(question) {
      const index = this.questions.findIndex(o => o.id === question.id);
      if (index > 0) {
        const a = this.questions[index - 1];
        this.questions[index - 1] = this.questions[index];
        this.questions[index] = a;
      }
      this.questions = [...this.questions];
    },
    moveDown(question) {
      const index = this.questions.findIndex(o => o.id === question.id);
      if (index < this.questions.length - 1) {
        const a = this.questions[index + 1];
        this.questions[index + 1] = this.questions[index];
        this.questions[index] = a;
      }
      this.questions = [...this.questions];
    },
    remove(question) {
      this.questions = this.questions.filter(q => q.id !== question.id);
    }
  }
};
</script>

<style lang="scss" scoped>
.p-modal {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(255, 255, 255, 0.4);
  display: none;
  z-index: 999;

  &.show {
    display: block;
  }

  .p-content {
    margin: 3% auto;
    max-width: 600px;
    background: #fff;
    box-shadow: 2px 2px 10px 0px #999;
    max-height: 90%;
    overflow: auto;
    display: flex;
    flex-direction: column;
    align-items: stretch;

    .p-title {
      font-size: 125%;
      padding: 1rem;
    }

    .p-body {
      flex: 1;
      min-height: 0;
      overflow: auto;

      .no-data {
        margin: 3rem auto;
        text-align: center;
      }
    }

    .p-actions {
      padding: 1rem;
      text-align: right;
    }
  }
}
</style>
