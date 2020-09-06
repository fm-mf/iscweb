<template>
  <div class="barcode-reader">
    <div v-if="error" class="error">Error occurred: {{ error }}</div>
    <div class="title">
      <i class="fas fa-barcode"></i>
      <span>Barcode Reader</span>
      <div class="close-button" @click="$emit('close')">
        <i class="fas fa-times"></i> Cancel
      </div>
    </div>
    <video
      id="video"
      width="300"
      height="200"
      style="border: 1px solid gray"
    ></video>

    <div class="tips">
      Image of the barcode has to be clear and focused
    </div>
  </div>
</template>

<script>
import { BrowserBarcodeReader } from '@zxing/library/esm5';

export default {
  data: () => ({
    error: null,
    reader: null
  }),
  created() {
    this.reader = new BrowserBarcodeReader();
    this.reader
      .decodeOnceFromVideoDevice(undefined, 'video')
      .then(result => this.$emit('code', result.text))
      .catch(err => {
        this.error = err;
      });
  },
  beforeDestroy() {
    if (this.reader) {
      this.reader.stopAsyncDecode();
      this.reader = null;
    }
  }
};
</script>

<style scoped lang="scss">
.barcode-reader {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background: #000;
  z-index: 10;

  .title {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    padding: 0.5rem;
    text-align: left;
    display: flex;
    align-items: center;
    z-index: 5;

    .fas {
      margin-right: 0.5rem;
    }

    > span {
      flex: 1;
    }

    .close-button {
      flex: 0;
      cursor: pointer;
      display: flex;
      align-items: center;
      color: #ccc;

      .fas {
        margin-right: 0.5rem;
      }
    }
  }

  .tips {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    padding: 0.5rem;
    text-align: center;
  }

  video {
    width: 100%;
    height: 100%;
  }
}
</style>
