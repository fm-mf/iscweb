<template>
    <div class="input-group">
        <div id="url" class="input-group-prepend">
            <span class="input-group-text">
                <i class="fas fa-link"></i>
            </span>
        </div>
        <input
            id="unique_url"
            type="text"
            class="form-control"
            :value="url"
            aria-describedby="url"
            readonly=""
        />
        <div class="input-group-append">
            <button
                v-tooltip:right="tooltipTest"
                class="btn btn-secondary"
                type="button"
                @mouseleave="mouseLeave"
                @click="copy"
            >
                <i class="fas fa-copy"></i>
            </button>
        </div>
    </div>
</template>
<script>
function bsTooltip(el, binding, updating = false) {
    let trigger;
    if (
        binding.modifiers.focus ||
        binding.modifiers.hover ||
        binding.modifiers.click
    ) {
        const t = [];
        if (binding.modifiers.focus) t.push('focus');
        if (binding.modifiers.hover) t.push('hover');
        if (binding.modifiers.click) t.push('click');
        trigger = t.join(' ');
    }
    $(el).tooltip({
        title: binding.value,
        placement: binding.arg,
        trigger: trigger,
        html: binding.modifiers.html
    });
    // To update title after click
    if (updating) {
        $(el)
            .attr('title', binding.value)
            .tooltip('fixTitle');
        // HACK: Not show when mouse is left.
        if (binding.value !== 'Copy') $(el).tooltip('show');
    }
}

export default {
    directives: {
        tooltip: {
            bind: bsTooltip,
            update(el, binding) {
                bsTooltip(el, binding, true);
            },
            unbind(el, binding) {
                $(el).tooltip('destroy');
            }
        }
    },

    props: {
        url: {
            type: String
        }
    },

    data() {
        return {
            buttonTitle: 'Copy',
            show: false
        };
    },

    computed: {
        tooltipTest: function() {
            return this.buttonTitle;
        }
    },

    methods: {
        copy(event) {
            const url = document.getElementById('unique_url');
            url.select();
            const suc = document.execCommand('copy');
            this.buttonTitle = 'Copied!';
            //show = true;
        },
        mouseLeave() {
            this.buttonTitle = 'Copy';
        }
    }
};
</script>
