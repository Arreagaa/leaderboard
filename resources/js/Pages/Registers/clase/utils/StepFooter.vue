<script setup>
const props = defineProps({
  modelValue: {
      type: [String, Number, File],
      default: '',
  },
  max: {
      type: Number,
      default: 1,
  },
});

const emit = defineEmits(['update:modelValue']);

const next = ()=>{
  emit('update:modelValue', props.modelValue + 1)
}
const previous = ()=>{
  emit('update:modelValue', props.modelValue - 1)
}

</script>

<template>
  <div class="flex justify-end mt-4">
    <button
      v-if="modelValue > 1"
      class="l-btn-secondary mx-4"
      @click="previous()"
    >
      Regresar
    </button>
    <button
      v-if="modelValue < max"
      class="l-btn-primary"
      @click="next()"
    >
      Siguiente
    </button>
    <button
      v-if="modelValue == max"
      class="l-btn-primary"
      type="submit"
    >
      Enviar
    </button>
  </div>
</template>