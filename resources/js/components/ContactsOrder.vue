<template>
    <draggable
        v-model="contacts"
        tag="ul"
        class="list-group contacts"
        :animation="250"
        @change="orderChanged"
    >
        <contact
            v-for="contact in contacts"
            :key="contact.id"
            class="list-group-item"
            :contact="contact"
            @delete="deleteContact(contact.id)"
        ></contact>
    </draggable>
</template>

<script>
import axios from 'axios';
import Draggable from 'vuedraggable';
import Contact from './Contact';

export default {
    name: 'ContactsOrder',
    components: {
        Draggable,
        Contact
    },
    data() {
        return {
            contacts: []
        };
    },
    mounted() {
        this.loadContacts();
    },
    methods: {
        loadContacts: loadContacts,
        deleteContact: deleteContact,
        orderChanged: orderChanged
    }
};

function loadContacts() {
    axios
        .get(`/partak/settings/contacts/data`)
        .then(response => {
            this.contacts = response.data.data;
        })
        .catch(error => {
            console.log(error);
        });
}

function deleteContact(contactId) {
    this.contacts = this.contacts.filter(value => {
        return value.id !== contactId;
    });
}

function orderChanged(event) {
    const data = {
        oldIndex: event.moved.oldIndex + 1,
        newIndex: event.moved.newIndex + 1
    };
    axios
        .post(`/partak/settings/contacts/${event.moved.element.id}/move`, data)
        .then(response => {})
        .catch(error => {
            console.log(error);
        });
}
</script>
