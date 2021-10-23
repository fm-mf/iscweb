<template>
    <div class="d-flex justify-content-between">
        <transition-group name="slide-fade" tag="ul" class="list-group mx-auto">
            <li
                v-for="item in items"
                :key="item.id_user"
                class="list-group-item student"
            >
                <exchange-student
                    :student="item"
                    :url="url"
                    :first-id="firstId"
                    :esn-card-number-length="esnCardNumberLength"
                    @saved="onSaved(item)"
                    @skip="onSaved(item)"
                ></exchange-student>
            </li>
        </transition-group>
        <div class="ml-3 preregistration-options">
            <div class="form-group">
                <label for="phoneNumberLength">Phone number length</label>
                <input
                    id="phoneNumberLength"
                    v-model.number="phoneNumberLength"
                    class="form-control"
                    type="number"
                    name="phoneNumberLength"
                />
                <small class="form-text text-muted">Set focus to ESNcard number after entering specified number
                    of characters into Phone number input</small>
            </div>
            <div class="form-group">
                <label for="esnCardNumberLength">ESNcard number length</label>
                <input
                    id="esnCardNumberLength"
                    v-model.number="esnCardNumberLength"
                    class="form-control"
                    type="number"
                    name="esnCardNumberLength"
                />
                <small class="form-text text-muted">Try to save data after entering specified number of
                    characters into ESNcard number input</small>
            </div>
            <div class="form-group">
                <label for="limit">Number of students to show</label>
                <input
                    id="limit"
                    v-model.number="limit"
                    class="form-control"
                    type="number"
                    name="limit"
                    min="1"
                />
                <small class="form-text text-muted">Load this number of students</small>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import ExchangeStudent from './ExchangeStudent.vue';

export default {
    components: {
        ExchangeStudent
    },

    props: {
        url: String,
        defaultLimit: Number
    },

    data() {
        return {
            items: [],
            esnCardNumberLength: 11,
            phoneNumberLength: 12,
            limit: this.defaultLimit
        };
    },

    computed: {
        firstId() {
            return this.items[0]?.id_user;
        },
        lastItem() {
            return this.items.length > 0
                ? this.items[this.items.length - 1]
                : {};
        }
    },

    watch: {
        limit(newValue, oldValue) {
            if (newValue < 1) {
                this.limit = 1;
                return;
            }
            if (newValue > this.items.length) {
                this.update(newValue - this.items.length, this.lastItem);
            } else {
                this.items.splice(newValue, this.items.length - newValue);
            }
        }
    },

    created() {
        this.update();
    },

    methods: {
        onSaved(user) {
            const lastItem = this.lastItem;
            this.items.splice(this.items.indexOf(user), 1);
            this.update(1, lastItem);
        },
        async update(limit = this.limit, user = {}) {
            try {
                const response = await axios.get(this.url, {
                    params: {
                        id: user.id_user ?? 0,
                        lastName: user.last_name ?? '',
                        firstName: user.first_name ?? '',
                        limit: limit
                    }
                });
                this.items.push(...response.data.data);
            } catch (error) {
                console.error(error);
            }
        }
    }
};
</script>

<style>
.student {
    width: 500px;
}

.preregistration-options {
    max-width: 13rem;
}

.list-group-item {
    transition: all 0.3s ease-in-out;
}

.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s ease-in;
    position: absolute;
}

.slide-fade-leave-to {
    opacity: 0;
}

.slide-fade-enter {
    opacity: 0;
    transform: translateY(20rem);
}
</style>
