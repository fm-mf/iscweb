<template>
    <div>
        <div v-if="alertVisible" :class="alertClass" class="alert sticky-top text-left mt-3" role="alert">
            <button type="button" class="close" aria-label="Close" @click="closeAlert">
                <span aria-hidden="true">&times;</span>
            </button>
            <span v-html="alertMessage" />
        </div>
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
                @delete="deleteContact"
            ></contact>
        </draggable>
    </div>
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
            contacts: [],
            alertVisible: false,
            alertMessage: '',
            alertType: '',
        };
    },
    computed: {
        alertClass() {
            return this.alertType === 'error'
                ? 'alert-danger'
                : 'alert-success';
        },
    },
    mounted() {
        this.loadContacts();
    },
    methods: {
        loadContacts: loadContacts,
        deleteContact: deleteContact,
        orderChanged: orderChanged,
        showSuccessAlert: showSuccessAlert,
        showErrorAlert: showErrorAlert,
        showAlert: showAlert,
        closeAlert: closeAlert,
    },
};

function loadContacts() {
    axios
        .get(`/partak/settings/contacts/data`)
        .then(response => {
            this.contacts = response.data.data;
        })
        .catch(error => {
            this.showErrorAlert(error.response.data);
        });
}

function deleteContact(contactId, message) {
    this.contacts = this.contacts.filter(value => {
        return value.id !== contactId;
    });
    this.showSuccessAlert(message);
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
            this.showErrorAlert(error.response.data.message);
        });
}

function showAlert(message, timeout = 5000, type = 'success') {
    this.alertVisible = true;
    this.alertMessage = message;
    this.alertType = type;
    if (timeout != null) {
        setTimeout(this.closeAlert, timeout);
    }
}

function showErrorAlert(message, timeout = 5000) {
    this.showAlert(`<i class="fas fa-times"></i> ${message}`, timeout, 'error');
}

function showSuccessAlert(message, timeout = 5000) {
    this.showAlert(`<i class="fas fa-check"></i> ${message}`, timeout, 'success');
}

function closeAlert() {
    this.alertVisible = false;
}
</script>
