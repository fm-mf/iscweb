<template>
    <ul class="list-group">
        <transition name="slide-fade">
        <li class="list-group-item student" v-show="visible">
            <div class="student-info">
                <h3><span>{{ student.person.last_name }}</span>, {{ student.person.first_name }} ({{student.id_user}})</h3>
                <small>{{ student.person.user.email }}</small>
                <div class="form-goup">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" v-model="phone" class="form-control">
                </div>
                <div class="form-goup">
                    <label for="esn">ESN Card Number</label>
                    <input type="text" name="esn" id="esn" v-model="esn" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-warning" @click="save">Save</button>
                </div>
            </div>
        </li>
        </transition>
    </ul>
</template>

<style>
    .student {
        width: 500px;
    }

    .student h3 {
        margin-bottom: 3px;
    }

    .student h3 span {
        text-transform: uppercase;
    }

    .student img {
        width: 80px;
        float: left;
    }

    .student-info {
    }
    .student-info button {
        margin-top: 10px;
    }

    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all .3s ease;
    }
    .slide-fade-leave-active {
        transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active for <2.1.8 */ {
        transform: translateY(-30px);
        opacity: 0;
    }
</style>

<script>

    export default {
        props: ['student', 'url'],
        data: function() {
            return {
                visible: true,
                phone: '',
                esn: ''
            }
        },

        methods: {
            save() {
                if (!this.esn || !this.phone) {
                    console.log('errrr');
                    return;
                }
                console.log('saving');
                var _this = this;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var url = _this.url + '/save';
                console.log(url);
                $.ajax({
                    url: url,
                    method: 'post',
                    dataType: 'json',
                    data: {
                        id: _this.student.id_user,
                        phone: _this.phone,
                        esn: _this.esn
                    },
                }).done(function(newData) {
                    console.log('saved');
                    _this.visible = false;
                    _this.$emit('saved');
                }).fail(function(error) {
                    alert('error');
                });


            }
        }
    };

</script>
