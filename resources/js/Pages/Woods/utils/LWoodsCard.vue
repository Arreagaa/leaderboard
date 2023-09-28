<script setup>
    import { ref } from 'vue';

  const props = defineProps({
    titleHeader: {
      type: String,
      default: ""
    }
  })
    const active = ref(false)
</script>
<template>
  <div
    class="px-4 py-2 text-sm text-gray-700 bg-gray-200 flex items-center cursor-pointer mt-4"
    @click="active = !active"
  >
    <l-icon
      :icon="`fa-solid fa-circle-${!active ? 'plus' : 'minus'}`"
      class="text-lg mr-2"
    /> 
    <span>{{ titleHeader }}</span>
  </div>
  <div
    v-if="active"
    class="p-3 border border-gray-200"
  >
    <slot />
  </div>
</template>