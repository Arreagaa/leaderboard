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
    class="shadow bg-slate-600 px-4 py-2 rounded-md cursor-pointer"
  >
    <span class="text-white">{{ name }}</span>
  </a>
</template>