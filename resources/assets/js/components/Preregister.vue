<template>
    <div>
        <exchange-student v-for="item in model.items" :key="item.id_user" :student="item" :url="url" @saved="onSaved(item.id_user)"></exchange-student>
    </div>
</template>

<script>
    import ExchangeStudent from './ExchangeStudent.vue'

    class StudentsModel {
        constructor($url, $currentId, $currentLastName)
        {
            this.items = [];
            this.url = $url;
            this.lastId = $currentId - 1;
            this.lastLastName = $currentLastName;
            this.update();
        }

        update($limit = 30)
        {
            var _this = this;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log (_this.url);
            console.log(_this.lastLastName);
            $.ajax({
                url: (_this.url),
                method: 'post',
                dataType: 'json',
                data: {
                    id: _this.lastId + 1,
                    lastName: _this.lastLastName,
                    limit: $limit
                },
            }).done(function(newData) {
                console.log('data:');
                console.log(newData);

                if ($limit == 1) {
                    _this.items.push(newData[0]);
                } else {
                    _this.items = newData;
                }

                _this.lastId = _this.items[_this.items.length - 1].id_user;
                _this.lastLastName = _this.items[_this.items.length - 1].person.last_name;
            }).fail(function(error) {
                alert('error');
            });
        }

        all()
        {
            return this.items;
        }
    }

    export default {

        props: ['url', 'currentId', 'currentLastName'],

        components: {
            ExchangeStudent
        },

        data () {
            return {
                model: new StudentsModel(this.url, this.currentId, this.currentLastName)
            }
        },

        computed: {
        },

        methods: {
            onSaved(id) {
                console.log('saving ' + id);
                this.model.update(1);
            }
        }
    };
</script>
