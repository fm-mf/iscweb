<template>
    <transition name="modal">
        <div class="modal-mask" @click="$emit('cancel')">
            <div class="modal-wrapper">
                <div class="modal-container" @click.stop>
                    <div class="modal-header">
                        <slot name="header" />
                    </div>

                    <div class="modal-body">
                        <slot />
                    </div>

                    <div class="modal-footer">
                        <slot name="footer" />
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
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
