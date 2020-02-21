<template xmlns:v-on="http://www.w3.org/1999/xhtml">
  <transition name="modal">
    <div class="modal-mask" @click="$emit('cancel')">
      <div class="modal-wrapper">
        <div class="modal-container" @click.stop>
          <div class="modal-header">
            <slot name="header">
              Confirmation dialog
            </slot>
          </div>

          <div class="modal-body">
            <slot name="content">
              <img src="/img/partak/speedy.jpg" class="img-circle" />
              <slot name="body">
                Do you wish to proceed?
              </slot>
            </slot>
            <div class="clearfix"></div>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="btn btn-success" @click="$emit('submit')">
                Yes
              </button>
              <button class="btn btn-danger" @click="$emit('cancel')">
                No
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<style>
.modal-body img {
  width: 90px;
  float: left;
  margin-right: 20px;
  margin-left: 10px;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 400px;
  margin: 0px auto;
  padding: 0;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  border: 1px solid #fff;
  transition: all 0.3s ease;
}

.modal-header {
  border-top-left-radius: 5px;
  border-top-right-radius: 5px;
  border: 0 !important;
  background: #0079c1;
  color: #fff;
  text-align: center;
}

.modal-header h3 {
  margin-top: 0;
}

.modal-body {
  margin: 20px 0;
}

.modal-footer {
  background: #edf2f6;
}

.modal-default-button {
  float: right;
}

/*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>

<script>
export default {
  props: ['show'],

  data() {
    return {};
  },

  computed: {},

  created: function() {
    document.addEventListener('keydown', e => {
      if (this.show && e.keyCode == 27) {
        //esc key
        this.$emit('cancel');
      }
    });
  },

  methods: {
    onClick(event) {}
  }
};
</script>
