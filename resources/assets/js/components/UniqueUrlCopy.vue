<template>
    <div class="input-group">
        <span class="input-group-addon" id="url"><span class="glyphicon glyphicon-link"></span> </span>
        <input type="text" id="unique_url" class="form-control" :value="url" aria-describedby="url" readonly="">
        <span class="input-group-btn">
            <button
                class="btn btn-default"
                type="button"
                @mouseleave="mouseLeave"
                @click="copy"
                v-tooltip:right="tooltipTest"
            >
                <span class="glyphicon glyphicon-copy"></span>
            </button>
        </span>
    </div><!-- /input-group -->
</template>
<script>
    function bsTooltip(el, binding, updating = false) { 
        let trigger;
        if (binding.modifiers.focus || binding.modifiers.hover || binding.modifiers.click) {
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
                .tooltip('fixTitle')
            // HACK: Not show when mouse is left.
            if (binding.value !== 'Copy')
                $(el).tooltip('show')
        }
    }


    export default {

        props: {
            url: {
                type: String
            },
        },

        data () {
            return {
                buttonTitle: 'Copy',
                show: false,
            }
        },

        computed: {
            tooltipTest: function() {
                return this.buttonTitle;
            }
        },

        directives: {
            tooltip: {
                bind: bsTooltip,
                update (el, binding) {
                    bsTooltip(el, binding, true)
                },
                unbind (el, binding) {
                    $(el).tooltip('destroy');
                }
            }
        },

        methods: {
            copy(event) {
                var url = document.getElementById('unique_url');
                url.select();
                var suc = document.execCommand('copy');
                this.buttonTitle = 'Copied!';
                //show = true;
            },
            mouseLeave() {
                this.buttonTitle = 'Copy'
            }
        }
    };
</script>