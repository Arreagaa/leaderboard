<script setup>
const props = defineProps({
  name: {
    type: String,
    default : ''
  },
  url: {
    type: String,
    default : ''
  }
})
</script>
<template>
  <a
    :href="url"
    class="l-btn-secoundary"
  >
    <span class="text-white">{{ name }}</span>
  </a>
</template>