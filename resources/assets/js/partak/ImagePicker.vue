<template>
  <div
    v-if="show"
    :class="{ 'p-container': true, dropping }"
    @dragover="handleDragOver"
    @dragenter="handleDragEnter"
    @dragleave="handleDragLeave"
    @dragend="dragCount = 0"
    @drop="handleDrop"
  >
    <div v-show="dropping" class="drop">Drop image here</div>
    <div class="picker">
      <div class="p-title">Image picker</div>
      <div class="p-body">
        <div v-if="uploading" class="loader">
          <span class="fas fa-paper-plane upload-anim" />
          Uploading
        </div>
        <div v-if="error" class="error">
          <div>Failed to upload image:</div>
          <div>{{ error }}</div>
          <button type="button" class="btn btn-primary" @click="error = null">OK</button>
        </div>
        <div v-if="rawImage || image" class="p-image">
          <img :src="rawImage || `${basePath}/${image}`" alt="" />
        </div>
        <div v-if="!rawImage && !image" class="no-image">
          Drop image here or select it manually
        </div>
        <div class="p-change">
          <input type="file" accept="image/*" @change="handleChange" />
          <button type="button" class="btn btn-outline-secondary" @click="$emit('cancel')">
            <span class="fas fa-times" /> Cancel
          </button>
          <button type="button" :disabled="file == null" class="btn btn-primary" @click="handleOk">
            <span class="fas fa-check" />
            Change
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const MAX_SIZE = 2 * 1024 * 1024;

export default {
  props: {
    image: String,
    show: Boolean,
    basePath: String
  },
  data() {
    return {
      file: null,
      rawImage: null,
      dragCount: 0,
      uploading: false,
      error: null
    };
  },
  computed: {
    dropping() {
      return this.dragCount > 0;
    }
  },
  watch: {
    file() {
      if (this.file.size > MAX_SIZE) {
        this.error = 'Maximum file size is 2 MiB';
        this.file = null;
        return;
      }

      if (!this.file.type.match('image.*')) {
        this.error = 'Only image files are allowed';
        this.file = null;
        return;
      }

      if (window.Blob && window.File && window.FileReader) {
        const reader = new FileReader();
        reader.onload = e => {
          this.rawImage = e.target.result;
        };
        reader.readAsDataURL(this.file);
      }
    }
  },
  methods: {
    handleChange(e) {
      const files = Array.from(e.target.files);
      if (files.length > 0) {
        this.file = files[0];
      }
    },
    handleDragOver(e) {
      e.stopPropagation();
      e.preventDefault();
      e.dataTransfer.dropEffect = 'copy';
    },
    handleDrop(e) {
      e.stopPropagation();
      e.preventDefault();
      this.dragCount = 0;

      const files = Array.from(e.dataTransfer.files);
      if (files.length > 0) {
        this.file = files[0];
      }
    },
    handleDragEnter() {
      this.dragCount++;
    },
    handleDragLeave() {
      this.dragCount--;
    },
    async handleOk() {
      if (this.file) {
        this.uploading = true;

        const formData = new FormData();
        formData.append('file', this.file);

        try {
          const response = await fetch('/partak/trips/upload-option', {
            method: 'POST',
            body: formData,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          if (!response.ok) {
            throw new Error(await response.text());
          }

          this.rawImage = null;
          const result = await response.json();
          this.$emit('change', result.path);
        } catch (e) {
          this.error = e;
        } finally {
          this.uploading = false;
        }
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.p-container {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(255, 255, 255, 0.8);
  z-index: 999;
}

.drop {
  position: absolute;
  top: 5%;
  left: 5%;
  bottom: 5%;
  right: 5%;
  text-align: center;
  font-size: 200%;
  z-index: 2;
  background: rgba(255, 255, 255, 0.9);
  border: 5px dashed #ddd;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #999;
}

.picker {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transform-origin: center center;
  max-width: 600px;
  background: #fff;
  border-radius: 5px;
  box-shadow: 2px 2px 10px 0px #999;
  max-height: 90%;
  overflow: auto;
  display: flex;
  flex-direction: column;
  align-items: stretch;
  z-index: 1;

  .p-body {
    position: relative;
    overflow: auto;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    align-items: stretch;
  }

  .loader {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    .upload-anim {
      animation: loader-anim 800ms;
      animation-iteration-count: infinite;
      color: #999;
      font-size: 200%;
      margin-bottom: 1rem;
    }
  }

  .error {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.9);
    padding: 10% 2rem;
    text-align: center;
    color: #990000;
  }

  .p-title {
    font-size: 125%;
    padding: 1rem;
  }

  .p-image {
    overflow: auto;
    flex-grow: 1;
    padding: 1rem;
    text-align: center;

    > img {
      max-width: 100%;
      max-height: 500px;
    }
  }

  .p-change {
    padding: 1rem;
    display: flex;
    align-items: center;
    justify-content: flex-end;

    .btn {
      margin-left: 1rem;
    }
  }
}

.no-image {
  margin: 5rem 1rem;
  text-align: center;
}

@keyframes loader-anim {
  0% {
    transform: scale(1);
  }
  50% {
    transform: scale(0.5);
  }
  100% {
    transform: scale(1);
  }
}
</style>
