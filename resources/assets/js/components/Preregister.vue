<template>
  <div>
    <exchange-student
      v-for="item in items"
      :key="item.id_user"
      :student="item"
      :url="url"
      @saved="onSaved(item.id_user)"
    ></exchange-student>
  </div>
</template>

<script>
import ExchangeStudent from './ExchangeStudent.vue';

export default {
  components: {
    ExchangeStudent
  },

  props: {
    url: String,
    currentId: Number,
    currentLastName: String
  },

  data() {
    return {
      items: [],
      lastId: this.currentId - 1,
      lastLastName: this.currentLastName
    };
  },

  created() {
    this.update();
  },

  methods: {
    onSaved() {
      this.model.update(1);
    },
    async update(limit = 30) {
      try {
        const response = await fetch(this.url, {
          method: 'post',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: this.lastId + 1,
            lastName: this.lastLastName,
            limit: limit
          })
        });
        const newData = await response.json();

        if (limit == 1) {
          this.items.push(newData[0]);
        } else {
          this.items = newData;
        }

        if (this.items.length > 0) {
          this.lastId = this.items[this.items.length - 1].id_user;
          this.lastLastName = this.items[
            this.items.length - 1
          ].person.last_name;
        }
      } catch (err) {
        alert(err);
      }
    }
  }
};
</script>
