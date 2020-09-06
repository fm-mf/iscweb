<template>
  <div class="input-group">
    <div class="input-group-prepend">
      <button
        type="button"
        class="btn btn-outline-secondary dropdown-toggle"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="reset"
      >
        {{ selectedField.title }}
      </button>
      <div class="dropdown-menu">
        <a
          v-for="field in fields"
          :key="field.title"
          class="dropdown-item"
          @click="setField(field)"
        >
          {{ field.title }}
        </a>
      </div>
    </div>
    <input
      :id="barCode ? 'barcode-input' : ''"
      v-model="search"
      type="text"
      :placeholder="placeholder"
      class="form-control autocomplete-input"
      aria-label="..."
      @keydown.down="down"
      @keydown.up="up"
      @input="update"
      @keydown.enter="hit"
      @keydown.esc="reset"
      @click="update"
      @blur="blur"
    />
    <ul v-show="focused && charactersWritten >= 3" class="typehead listgroup">
      <loader :loaded="!loading" fill />
      <li
        v-if="loading && !hasItems"
        class="list-group-item loading-placeholder"
      ></li>
      <template v-if="!loading && !hasItems">
        <li class="list-group-item text-center py-4">
          Nothing found <i class="fas fa-sad-cry"></i>
        </li>
        <li v-if="createUrl" class="list-group-item text-center">
          <a class="btn btn-primary" href="#" @mousedown="handleNew">
            <i class="fas fa-plus"></i> Add new student
          </a>
        </li>
      </template>
      <li
        v-for="(item, index) in items"
        :key="item.link"
        class="list-group-item user-item"
        :class="{ activeitem: activeClass(index) }"
        @mousedown="hit"
        @mousemove="setActive(index)"
      >
        <span v-if="item.image" class="img-wrapper">
          <img :src="item.image" class="img-circle" />
        </span>
        <a :href="item.link">
          {{ item.topline }} <br />
          <small>{{ item.subline }}</small>
        </a>
      </li>
    </ul>
    <div v-if="showBarCode" class="input-group-append">
      <barcode-button target="barcode-input" />
    </div>
    <div v-if="showSemesters" class="input-group-append">
      <button
        type="button"
        class="btn btn-outline-secondary dropdown-toggle semesters-button"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
        @click="reset"
      >
        {{ allSemesters ? 'All semesters' : 'Current semester' }}
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" @click="allSemesters = false">
          Current semester
        </a>
        <a class="dropdown-item" @click="allSemesters = true">
          All semesters
        </a>
      </div>
    </div>
    <slot></slot>
  </div>
</template>

<script>
import axios from 'axios';
import debounce from 'debounce';
import Loader from './Loader';

export default {
  components: {
    Loader
  },
  props: {
    url: String,
    image: Object,
    fields: Array,
    topline: Array,
    subline: Array,
    placeholder: String,
    target: String,
    showSemesters: Boolean,
    createUrl: String,
    showBarCode: Boolean
  },
  data: function() {
    return {
      focused: false,
      limit: 5,
      search: '',
      selectedField: this.fields[0],
      current: -1,
      items: [],
      loading: false,
      allSemesters: false
    };
  },
  computed: {
    charactersWritten() {
      return this.search.length;
    },
    hasItems() {
      return this.items.length > 0;
    }
  },
  methods: {
    setField(selectedField) {
      this.selectedField = selectedField;
    },
    up() {
      if (this.current > 0) {
        this.current--;
      } else if (this.current === -1) {
        this.current = this.items.length - 1;
      } else {
        this.current = -1;
      }
    },
    down() {
      if (this.current < this.items.length - 1) {
        this.current++;
      } else {
        this.current = -1;
      }
    },
    activeClass(index) {
      return this.current === index;
    },
    setActive(index) {
      this.current = index;
    },
    hit() {
      if (this.current >= 0) {
        window.location.href = this.items[this.current].link;
      }
    },
    update() {
      if (this.charactersWritten < 3) {
        this.reset();
        return;
      }

      this.focused = true;
      this.loading = true;
      this.debouncedRequest(this.search);
    },
    reset() {
      this.items = [];
      this.current = -1;
    },
    blur() {
      this.focused = false;
    },
    handleNew() {
      window.location.href = this.createUrl;
    },

    debouncedRequest: debounce(function(input) {
      axios
        .request({
          url: this.url,
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            field: this.selectedField,
            input,
            topline: this.topline,
            subline: this.subline,
            limit: this.limit,
            target: this.target,
            allSemesters: this.allSemesters
          }
        })
        .then(res => {
          this.loading = false;
          this.items = res.data.items;
        })
        .catch(err => {
          this.loading = false;
          alert('Failed to fetch list of people: ' + err);
        });
    }, 200)
  }
};
</script>

<style lang="scss">
@import 'node_modules/bootstrap/scss/functions';
@import 'node_modules/bootstrap/scss/variables';
@import 'node_modules/bootstrap/scss/mixins/_breakpoints';

.dropdown-toggle {
  border-top-left-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
}

.typehead {
  position: absolute;
  width: 100%;
  top: 38px;
  left: 0;
  background: #fff;
  list-style: none;
  z-index: 1000;
  padding: 0;

  .loading-placeholder {
    height: 100px;
  }

  li.user-item {
    padding: 10px 16px;
    cursor: pointer;

    a {
      color: #000000;

      &:hover {
        text-decoration: none;
      }

      small {
        color: slategrey;
      }
    }

    img {
      width: 40px;
    }

    .img-wrapper {
      display: block;
      float: left;
      padding-right: 10px;
    }
  }

  .activeitem {
    background: #1aafd0;
    color: #fff;

    a,
    a small {
      color: #fff !important;
    }
  }
}

.input-group-append .btn.btn {
  z-index: inherit;
}

@include media-breakpoint-down(sm) {
  .semesters-button {
    max-width: 5rem;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>
