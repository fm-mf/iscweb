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
        <div ref="video" class="video-container"></div>
        <div class="tips">
            Image of the barcode has to be clear and focused
        </div>
    </div>
</template>

<script>
import Quagga from 'quagga';

export default {
    data: () => ({
        error: null,
        reader: null
    }),
    mounted() {
        console.log(this.$refs.video);

        Quagga.init(
            {
                inputStream: {
                    name: 'Live',
                    type: 'LiveStream',
                    target: this.$refs.video
                },
                decoder: {
                    readers: ['code_128_reader']
                },
                numOfWorkers: 0
            },
            err => {
                if (err) {
                    this.error = err;
                }

                Quagga.start();
            }
        );
        Quagga.onDetected(this.handleDetected);
    },
    beforeDestroy() {
        Quagga.offDetected(this.handleDetected);
        Quagga.stop();
    },
    methods: {
        handleDetected(result) {
            if (result.codeResult && result.codeResult.code !== undefined) {
                this.$emit('code', result.codeResult.code);
            }
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
}
</style>

<style lang="scss">
/** This has to be unscoped, since the element is created by Quagga */
.video-container {
    width: 100%;
    height: 100%;

    > video {
        width: 100%;
        height: 100%;
    }
}
</style>
