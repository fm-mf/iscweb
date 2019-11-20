<template>
  <div class="done-step">
    <div class="done-message">
      <div class="icon">
        <i class="fas fa-check" />
      </div>
      <span>You have been registered</span>
    </div>

    <p>
      Thank you for registering. You can now go to
      <a href="/contact" target="blank">ISC Point</a> and pay the fee to get
      your spot.
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
export default {};
</script>

<style></style>
