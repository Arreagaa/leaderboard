<script setup>
import LBtnPrimary from '../buttons/LBtnPrimary.vue';
const props = defineProps({
  title: {
    type: String,
    default: '',
  },
  titleSingle: {
    type: String,
    default: '',
  }
})

const emit = defineEmits(['add'])
</script>
<template>
  <div class="flex justify-between items-center">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ title }}
    </h2>
    <div class="flex gap-4 items-center">
      <slot name="actions" />
      <button
        class="l-btn-primary"
        @click="$emit('add')"
      >
        {{ `Add ${titleSingle}` }}
      </button>
    </div>
  </div>
</template>