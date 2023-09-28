<script setup>
const props = defineProps({
  name: {
    type: String,
    default: ''
  },
  fieldFor: {
    type: String,
    default: ''
  },

})

</script>

<template>
  <div class="col-span-6 sm:col-span-3">
    <label
      :for="fieldFor"
      class="block text-sm font-medium text-gray-700"
    >
      {{ name }}
    </label>
    <slot />
  </div>
</template>