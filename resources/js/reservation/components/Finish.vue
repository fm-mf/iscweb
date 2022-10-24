<template>
    <div class="done-step">
        <div class="done-message">
            <div class="icon">
                <i class="fas fa-check" />
            </div>
            <span>You have reserved your spot at the trip</span>
        </div>

        <p v-if="isOw">
            Thank you for reserving your spot. You can now go to trip stand and
            pay the fee to get your spot. If you don't do this, your reservation
            will be cancelled.
        </p>
        <p v-else>
            Thank you for reserving your spot.
            <span v-if="!paymentOnSpot">
                You can now go to the
                <a href="/contact" target="blank">ISC Point</a> and pay the fee
                to get your spot.
            </span>
        </p>

        <p>
            If you can't make it, please cancel your spot using the link you've
            received in your e-mail to allow other students to take your spot.
        </p>

        <button @click="$emit('back')">
            <i class="fas fa-arrow-left"></i> Back to info
        </button>
    </div>
</template>

<script>
export default {
    props: {
        isOw: Boolean,
        paymentOnSpot: Boolean
    }
};
</script>

<style></style>
