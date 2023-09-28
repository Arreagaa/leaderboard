<script setup>
import { ref } from 'vue';

const props = defineProps({
  schedule: {
    type: Object,
    default: null
  }
})
</script>
<template>
  <div class="w-full rounded-md ">
    <div v-if="schedule != null">
      <div
        v-if="schedule.users_count == schedule.capacity"
        class="p-3 text-red bg-red-100 rounded-md mt-1"
      >
        <p class="text-red-400">
          No hay cupos disponibles
        </p>
      </div>
      <div v-else>
        <slot />
      </div>
    </div>
    <div
      v-else
      class="p-6 border border-gray-200 rounded-md mt-1"
    >
      <p class="">
        Selecciona un horario
      </p>
    </div>
  </div>
</template>