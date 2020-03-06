<template>
  <div>
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
          {{ model.selectedField.title }}
        </button>
        <div class="dropdown-menu">
          <a
            v-for="field in fields"
            :key="field.title"
            class="dropdown-item"
            @click="setfield(field)"
          >
            {{ field.title }}
          </a>
        </div>
      </div>
      <input
        v-model="model.input"
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
      <ul
        v-show="focused && model.charactersWritten() >= 3"
        class="typehead listgroup"
      >
        <loader :loaded="!model.loading" fill />
        <li
          v-if="model.items.length === 0 && model.loading"
          class="list-group-item loading-placeholder"
        ></li>
        <li
          v-if="!model.loading && model.items.length === 0"
          class="list-group-item text-center py-4"
        >
          Nothing found <i class="fas fa-sad-cry"></i>
        </li>
        <li
          v-for="(item, index) in model.items"
          :key="item.link"
          class="list-group-item"
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
      <slot></slot>
    </div>

    <!--
      <div style="padding-top: 150px;">
          Url: {{ model.url }} <br>
          Selected field: {{ model.selectedField }} <br>
          Input: {{ model.input }} <br>
          Current index: {{ model.current }} <br>
          Data: {{ model.items }}
      </div>
    -->
  </div>
</template>

<script>
import axios from 'axios';
import debounce from 'debounce';
import Loader from './Loader';

class AutocompleteModel {
  constructor($url, $fields, $topline, $subline, $target) {
    this.url = $url;
    this.fields = $fields;
    this.selectedField = $fields[0];

    this.input = '';
    this.current = -1;

    this.items = [];
    this.loading = false;

    this.topline = $topline;
    this.subline = $subline;

    this.limit = 5;

    this.target = $target;

    this.debouncedRequest = debounce(this.doRequest, 200);
  }

  update() {
    if (this.charactersWritten() < 3) {
      this.reset();
      return;
    }

    this.loading = true;
    this.debouncedRequest();
  }

  doRequest() {
    axios
      .request({
        url: this.url,
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          field: this.selectedField,
          input: this.input,
          topline: this.topline,
          subline: this.subline,
          limit: this.limit,
          target: this.target
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
  }

  setfield($fieldname) {
    this.selectedField = $fieldname;
    this.update();
  }

  up() {
    if (this.current > 0) {
      this.current--;
    } else if (this.current === -1) {
      this.current = this.items.length - 1;
    } else {
      this.current = -1;
    }
  }

  down() {
    if (this.current < this.items.length - 1) {
      this.current++;
    } else {
      this.current = -1;
    }
  }

  hasItems() {
    return this.items.length > 0;
  }

  charactersWritten() {
    return this.input.length;
  }

  reset() {
    this.items = [];
    this.current = -1;
  }

  currentLink() {
    return this.items[this.current].link;
  }
}
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
    target: String
  },
  data: function() {
    return {
      focused: false,
      model: new AutocompleteModel(
        this.url,
        this.fields,
        this.topline,
        this.subline,
        this.target
      )
    };
  },
  methods: {
    setfield($fieldname) {
      this.model.setfield($fieldname);
      console.log('setting field' + $fieldname.title);
    },
    up() {
      this.model.up();
    },
    down() {
      this.model.down();
    },
    activeClass(index) {
      return this.model.current === index;
    },
    setActive(index) {
      this.model.current = index;
    },
    hit() {
      if (this.model.current >= 0) {
        window.location.href = this.model.currentLink();
      }
    },
    update() {
      this.focused = true;
      this.model.update();
    },
    reset() {
      this.model.reset();
    },
    blur() {
      this.focused = false;
    }
  }
};
</script>

<style>
.dropdown-toggle {
  border-top-left-radius: 0px !important;
  border-bottom-left-radius: 0px !important;
}

.loading-placeholder {
  height: 100px;
}

.typehead {
  position: absolute;
  width: 90%;
  top: 38px;
  left: 0;
  background: #fff;
  list-style: none;
  z-index: 1000;
  padding: 0;
}

.typehead li {
  padding: 10px 16px;
  cursor: pointer;
}

.typehead li a {
  color: #000000;
}

.typehead li a small {
  color: slategrey;
}

.typehead a:hover {
  text-decoration: none;
}

.img-wrapper {
  display: block;
  float: left;
  padding-right: 10px;
}
.typehead img {
  width: 40px;
}

.activeitem {
  background: #1aafd0;
  color: #fff;
}

.activeitem a,
.activeitem a small {
  color: #fff !important;
}
</style>
