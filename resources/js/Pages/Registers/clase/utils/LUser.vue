<script setup>
    import { ref } from 'vue';
  
    const active = ref(false)
  
    const props = defineProps({
        type: {
            type: Number,
            default: 0
        },
    })
  </script>
<template>
  <div
    class="px-4 py-2 text-sm text-gray-700 bg-gray-200 flex items-center mt-4"
    @click="active = !active"
  >
    <l-icon
      :icon="`fa-solid fa-circle-${!active ? 'plus' : 'minus'}`"
      class="text-lg mr-2"
    /> 
    <span>Usuario {{ type }}</span>
  </div>
  <div
    v-if="active"
    class="p-3 border border-gray-200"
  >
    <slot />
  </div>
</template>