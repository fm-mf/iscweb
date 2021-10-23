<template>
    <li class="contact">
        <picture>
            <img :src="contact.photo" :alt="`${contact.position}'s photo`" />
        </picture>
        <ul class="list-unstyled contact-details">
            <li class="list-item name">{{ contact.name }}</li>
            <li class="list-item position">{{ contact.position }}</li>
            <li class="list-item email">
                Email:
                <a :href="`mailto:${contact.email}`">{{ contact.email }}</a>
            </li>
            <li v-if="contact.phone" class="list-item">
                Phone:
                <a :href="`tel:${contact.phone}`">{{
                    contact.phoneWithNBSpaces
                }}</a>
            </li>
        </ul>

        <ul class="list-unstyled">
            <li class="list-item">
                <div class="form-group">
                    <label @click="toggleVisibility">Show on web <input v-model="visible" type="checkbox"
                    /></label>
                </div>
            </li>
            <li class="list-item">
                <div class="form-group">
                    <label @click="togglePhoneVisibility">Show phone #
                        <input v-model="phoneVisible" type="checkbox"
                    /></label>
                </div>
            </li>
        </ul>

        <ul class="list-unstyled actions">
            <li class="list-item form-group">
                <a class="btn btn-primary" :href="editUrl">
                    <span class="fas fa-user-edit"></span> Edit
                </a>
            </li>
            <li class="list-item form-group">
                <button class="btn btn-danger" @click="deleteContact">
                    <span class="fas fa-trash-alt"></span> Delete
                </button>
            </li>
        </ul>
    </li>
</template>

<script>
import axios from 'axios';
import Button from './Button';

export default {
    name: 'Contact',
    components: { Button },
    props: ['contact'],
    data() {
        return {
            visible: this.contact.visible,
            phoneVisible: this.contact.phone_visible
        };
    },
    computed: {
        editUrl() {
            return `/partak/settings/contacts/${this.contact.id}/edit`;
        },
        deleteUrl() {
            return `/partak/settings/contacts/${this.contact.id}`;
        }
    },
    methods: {
        deleteContact: deleteContact,
        toggleVisibility: toggleVisibility,
        togglePhoneVisibility: togglePhoneVisibility
    }
};

function deleteContact() {
    const confirmed = confirm(
        `Delete contact entry for ${this.contact.position}?`
    );
    if (!confirmed) {
        return;
    }

    axios
        .delete(this.deleteUrl)
        .then(response => {
            this.$emit('delete');
            document.getElementById('alert-success-wrapper').innerHTML =
                `<div class="alert alert-success alert-dismissable fade in">` +
                `    <btn class="close" data-dismiss="alert" aria-label="close"><span class="fas fa-times"></span></btn>` +
                `    <span class="fas fa-check"></span> ${response.data.message}` +
                `</div>`;
            setTimeout(() => {
                $('#alert-success-wrapper > .alert').alert('close');
            }, 3000);
        })
        .catch(error => {
            console.log(error);
        });
}

function toggleVisibility() {
    axios
        .patch(this.deleteUrl, {
            id: this.contact.id,
            visible: !this.visible
        })
        .then(response => {})
        .catch(error => {
            console.log(error);
        });
}

function togglePhoneVisibility() {
    axios
        .patch(this.deleteUrl, {
            id: this.contact.id,
            phone_visible: !this.phoneVisible
        })
        .then(response => {})
        .catch(error => {
            console.log(error);
        });
}
</script>
