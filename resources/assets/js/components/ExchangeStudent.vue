<template>
  <ul class="list-group">
    <transition name="slide-fade">
      <li v-show="visible" class="list-group-item student">
        <div class="student-info">
          <h3>
            <span>
              {{ student.person.last_name }},
              {{ student.person.first_name }} ({{ student.id_user }})
            </span>
          </h3>
          <small>{{ student.person.user.email }}</small>
          <div class="form-goup">
            <label for="phone">Phone</label>
            <input
              id="phone"
              v-model="phone"
              type="text"
              name="phone"
              class="form-control"
            />
          </div>
          <div class="form-goup">
            <label for="esn">ESN Card Number</label>
            <input
              id="esn"
              v-model="esn"
              type="text"
              name="esn"
              class="form-control"
            />
          </div>
          <div class="form-group">
            <button class="btn btn-warning" @click="save">Save</button>
          </div>
        </div>
      </li>
    </transition>
  </ul>
</template>

<style>
.student {
  width: 500px;
}

.student h3 {
  margin-bottom: 3px;
}

.student h3 span {
  text-transform: uppercase;
}

.student img {
  width: 80px;
  float: left;
}

.student-info button {
  margin-top: 10px;
}

/* Enter and leave animations can use different */
/* durations and timing functions.              */
.slide-fade-enter-active {
  transition: all 0.3s ease;
}
.slide-fade-leave-active {
  transition: all 0.8s cubic-bezier(1, 0.5, 0.8, 1);
}
.slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active for <2.1.8 */ {
  transform: translateY(-30px);
  opacity: 0;
}
</style>

<script>
export default {
  props: {
    student: Object,
    url: String
  },
  data: function() {
    return {
      visible: true,
      phone: '',
      esn: ''
    };
  },

  methods: {
    async save() {
      if (!this.esn || !this.phone) {
        return;
      }

      try {
        await fetch(this.url + '/save', {
          method: 'post',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            id: this.student.id_user,
            phone: this.phone,
            esn: this.esn
          })
        });

        this.visible = false;
        this.$emit('saved');
      } catch (err) {
        alert(err);
      }
    }
  }
};
</script>
