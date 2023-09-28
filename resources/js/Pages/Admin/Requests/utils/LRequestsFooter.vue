<script setup>
    const emit = defineEmits('yes', 'no')
</script>
<template>
  <div class="flex justify-end p-3">
    <button
      type="submit"
      class="shadow text-white bg-red-600 px-4 py-2 rounded-md cursor-pointer mx-4"
      @click="emit('no')"
    >
      Rechazar
    </button>
    <button
      type="submit"
      class="shadow bg-slate-600 px-4 py-2 rounded-md cursor-pointer text-white"
      @click="emit('yes')"
    >
      Aceptar
    </button>
  </div>
</template>