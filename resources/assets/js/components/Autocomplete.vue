<template xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div>
        <div class="input-group form-group-lg">
            <div class="input-group-btn">
                <button type="button" class="btn btn-default btn-lg dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ model.selectedField.title }} <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li v-for="field in fields"><a href="#" @click="setfield(field)">{{ field.title }}</a></li>
                </ul>
            </div><!-- /btn-group -->
            <div class="dropdown">
                <input type="text" class="form-control  sharp-corners" v-model="model.input"
                       @keydown.down="down"
                       @keydown.up="up"
                       @input="update"

                       aria-label="...">
                <ul class="typehead listgroup" v-show="model.hasItems">
                    <li v-for="(item, index) in model.items" class="list-group-item" v-bind:class="{active: activeClass(index)}" @mousedown="hit" @mousemove="setActive(index)">
                        <a href="#"> {{item.topline}} <br> <small>{{ item.subline }}</small></a>
                   </li>
                </ul>
            </div>
            <slot></slot>
        </div><!-- /input-group -->

        <div style="padding-top: 150px;">
            Url: {{ model.url }} <br>
            Selected field: {{ model.selectedField }} <br>
            Input: {{ model.input }} <br>
            Current index: {{ model.current }}
        </div>
    </div>
</template>

<style>
    .typehead {
        position: absolute;
        width: 100%;
        top: 48px;
        left: 0;
        background: #fff;
        list-style: none;
        z-index: 1000;
        padding: 0;
    }

    .typehead li {
        padding: 10px 16px;
    }

    .active {
        color: red;
    }
</style>

<script>
    class AutocompleteModel
    {
        constructor($url, $fields, $topline, $subline)
        {
            this.url = $url;
            this.fields = $fields;
            this.selectedField = $fields[0];


            this.input = "";
            this.current = -1;

            this.items = [];
            this.loading = false;

            this.topline = $topline;
            this.subline = $subline;
        }

        update()
        {
            if (this.charactersWritten() < 3) {
                this.reset();
                return;
            }

            console.log("pulling");

            var _this = this;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: (_this.url),
                method: 'post',
                dataType: 'json',
                data: {
                    field: _this.selectedField,
                    input: _this.input,
                    topline: _this.topline,
                    subline: _this.subline
                },
            }).done(function(newData) {
                console.log(newData);
                _this.items = newData.items;
            }).fail(function(error) {
                alert('error');
            });
        }
        setfield($fieldname)
        {
            this.selectedField = $fieldname;
        }

        up()
        {
            if (this.current > 0) {
                this.current--;
            } else if (this.current === -1) {
                this.current = this.items.length - 1;
            } else {
                this.current = -1;
            }
        }

        down()
        {
            if (this.current < this.items.length - 1) {
                this.current++;
            } else {
                this.current = -1;
            }
        }

        hasItems()
        {
            return this.items.length > 0;
        }

        charactersWritten()
        {
            return this.input.length;
        }

        reset()
        {
            this.items = [];
            this.current = -1;
        }

    }
    export default {
        props: ['url', 'fields', 'topline', 'subline'],
        data: function () {
            return {
                model: new AutocompleteModel(this.url, this.fields, this.topline, this.subline)
            }
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
            activeClass (index)
            {
                return this.model.current === index;
            },
            setActive(index)
            {
                this.model.current = index;
            },
            hit()
            {

            },
            update()
            {
                this.model.update();
            }
        }
    }
</script>